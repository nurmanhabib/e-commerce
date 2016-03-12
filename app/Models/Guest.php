<?php

namespace App\Models;

use App\Supports\Contracts\Buyerable;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model implements Buyerable
{
	protected $guarded = [];

    public function getType()
    {
        return 'guest';
    }

    public function getFirstName()
    {
    	return $this->first_name;
    }

    public function getLastName()
    {
    	return $this->last_name;
    }

    public function getEmail()
    {
    	return $this->email;
    }

    public function invoices()
    {
    	return $this->morphMany(Invoice::class, 'buyerable');
    }
}