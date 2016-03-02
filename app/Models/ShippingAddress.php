<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
	protected $table = 'shipping_addresses';
	protected $guarded = [];
	
	public function user()
    {
        return $this->belongsTo(User::class);
    }
}