<?php

namespace App\Models\Notifications;

class PaymentConfirmed extends Notification
{
	public static $type = 'payment_confirmed';

	public function render()
	{
		return 'Thank you for your payment.';
	}
}