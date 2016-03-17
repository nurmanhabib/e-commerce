<?php

namespace App\Providers;

use App\Repositories\Notification\Notification;
use Illuminate\Support\ServiceProvider;

class NotificationServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->bind('notification', Notification::class);
	}
}