<?php

namespace App\Repositories\Notification\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Notification extends NotificationEloquent
{
    protected $table = 'notifications';
    protected $guarded = [];
    protected $with = ['users'];

    public static $type = '';

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notification', 'notification_id', 'user_id');
    }

    public function sender()
    {
        return $this->morphTo();
    }

    public function object()
    {
        return $this->morphTo();
    }

    public function newPivot(Model $parent, array $attributes, $table, $exists)
    {
        return new NotificationUser($parent, $attributes, $table, $exists);
    }

    protected function isSubType()
    {
        return get_class() !== get_class($this);
    }

    protected function getClass($type)
    {
        return (new \App\Repositories\Notification\Notification)->getClass($type);
    }

    protected function getType()
    {
        return static::$type;
    }
}