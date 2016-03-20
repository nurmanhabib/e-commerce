<?php

namespace App\Repositories\Notification;

use Illuminate\Database\Eloquent\Model;

class Notification
{
    public function getClass($type)
    {
        if (empty($type)) {
            throw new Exception('No notification type given');
        }

        $namespace = 'App\Models\Notifications';
        $namespace = join('\\', explode('\\', $namespace)) . '\\';

        return $namespace . studly_case($type);
    }

    public function create($type, Model $sender, Model $object = NULL, $users = array(), $data = NULL)
    {
        $class = $this->getClass($type);
        $notification = new $class();

        if ($data) {
            $notification->data = $data;
        }

        $notification->sender()->associate($sender);
        
        if ($object) {
            $notification->object()->associate($object);
        }

        $notification->save();

        foreach ($users as $user) {
            $notification_user = new Models\NotificationUser($notification);
            $notification_user->user()->associate($user);
            $notification_user->notification()->associate($notification);
            $notification_user->save();
        }

        return $notification->load('users');
    }
}