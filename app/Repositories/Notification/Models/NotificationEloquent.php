<?php

namespace App\Repositories\Notification\Models;

use Exception;
use Illuminate\Database\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class NotificationEloquent extends Model
{
    protected $isSuperType = false; // set true in super-class model
    protected $isSubType = false; // set true in inherited models
    protected $typeField = 'type'; //override as needed, only set on the super-class model

    public function mapData(array $attributes)
    {
        if (!$this->isSuperType) {
            return $this->newInstance();
        } else {
            if (!isset($attributes[$this->typeField])) {
                throw new Exception($this->typeField . ' not present in the records of a Super Model');
            } else {
                $class = $this->getClass($attributes[$this->typeField]);
                
                return new $class;
            }
        }
    }

    public function newFromBuilder($attributes = array(), $connection = NULL)
    {
        $model = $this->mapData((array) $attributes)->newInstance(array(), true);
        $model->setRawAttributes((array) $attributes, true);
        
        return $model;
    }

    public function newRawQuery()
    {
        $builder = $this->newEloquentBuilder($this->newBaseQueryBuilder());

        // Once we have the query builders, we will set the model instances
        // so the builder can easily access any information it may need
        // from the model while it is constructing and executing various
        // queries against it.
        $builder->setModel($this)->with($this->with);
        
        return $builder;
    }

    public function newQuery($excludeDeleted = true)
    {
        $builder = parent::newQuery($excludeDeleted);

        if ($this->isSubType()) {
            $builder->where($this->typeField, $this->getClass($this->typeField));
        }

        return $builder;
    }

    protected function isSubType()
    {
        return $this->isSubType;
    }

    protected function getClass($type)
    {
        return get_class($this);
    }

    protected function getType()
    {
        return get_class($this);
    }

    public function save(array $options = array())
    {
        if ($this->isSubType())
        {
            $this->attributes[$this->typeField] = $this->getType();
        }

        return parent::save($options);
    }

}