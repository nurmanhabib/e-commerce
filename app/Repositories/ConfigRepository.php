<?php

namespace App\Repositories;

use App\Models\Config;
use Prettus\Repository\Criteria\RequestCriteria;

class ConfigRepository extends Repository
{
    protected $fieldSearchable = ['name'];

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Config::class;
    }

    public function getAutoload()
    {
        $this->where('autoload', true);

        return $this->getAll();
    }

    public function getAll()
    {
        $config = $this->all();

        return $config->pluck('value', 'name');
    }

    public function getByName($name, $default = '')
    {
        if (config()->has($name)) {
            return config($name);
        } else {
            $config = $this->findByField('name', $name)->first();

            if ($config) {
                return $config->value;
            }
        }

        return $default;
    }

    public function setForAll(array $configs)
    {
        $results = [];

        foreach ($configs as $name => $value) {
            $autoload = true;

            if (is_array($value)) {
                $autoload   = array_get($value, 'autoload', $autoload);
                $value      = array_get($value, 'value', null);
            }

            $results[$name] = $this->setForName($name, $value, $autoload);
        }

        return $results;
    }

    public function setForName($name, $value, $autoload = true)
    {
        $config = $this->findByField('name', $name)->first();

        if ($config) {
            $config = $config->first();
        } else {
            $config = $this->makeModel();
            $config->name = $name;
        }

        $config->value      = $value;
        $config->autoload   = $autoload;

        return $config->save();
    }

    public function deleteByName($name)
    {
        $config = $this->findByField('name', $name);

        if ($config) {
            return $config->delete();
        } else {
            return false;
        }
    }
}