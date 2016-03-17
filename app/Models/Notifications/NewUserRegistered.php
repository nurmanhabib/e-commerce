<?php

namespace App\Models\Notifications;

class NewUserRegistered extends Notification
{
	public static $type = 'new_user_registered';

	public function render()
	{
		return 'New User registered.';
	}
}