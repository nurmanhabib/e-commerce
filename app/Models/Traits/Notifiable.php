<?php

namespace App\Models\Traits;

use App\Repositories\Notification\Models\NotificationUser;

trait Notifiable
{
	public function notifications()
	{
		return $this->hasMany(NotificationUser::class);
	}
}