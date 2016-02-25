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

    public function setForName($name, $value)
    {
        $config = $this->findByField('name', $name)->first();

        if ($config) {
            $config = $config->first();
        } else {
            $config = $this->makeModel();
            $config->name = $name;
        }

        $config->forceFill(compact('value'));

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