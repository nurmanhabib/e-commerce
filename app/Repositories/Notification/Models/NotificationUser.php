<?php

namespace App\Repositories\Notification\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationUser extends Pivot
{
    use SoftDeletes;

    protected $table = 'user_notification';
    protected $foreignKey = 'notification_id';
    protected $otherKey = 'user_id';
    protected $dates = ['deleted_at'];
    protected $visible = ['user_id', 'notification_id', 'created_at', 'updated_at', 'read_at'];

    public function __construct($parent = NULL, $attributes = array(), $table = '', $exists = false)
    {
        if (!$parent || !is_a($parent, Model::class))
        {
            $parent = new Notification;
        }

        if (empty($table))
        {
            $table = $this->table;
        }

        parent::__construct($parent, $attributes, $table, $exists);
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function($model)
        {
            $model->updateTimestamps();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function scopeUnread($query)
    {
        return $query->whereNull($this->table . '.read_at');
    }

    public function scopeRead($query)
    {
        return $query->whereNotNull($this->table . '.read_at');
    }

    public function setRead()
    {
        $this->read_at = new Carbon;
        $this->save();

        return $this;
    }

    public function setUnread()
    {
        $this->read_at = NULL;
        $this->save();

        return $this;
    }

    public function render()
    {
        return $this->notification->render();
    }
}