<?php

namespace App\Models\Notifications;

use App\Repositories\Notification\Models\Notification as NotificationModel;

abstract class Notification extends NotificationModel
{
    public function getIcon()
    {
        return asset('notification.png');
    }

    public function render()
    {
        return 'You have a notification.';
    }
}