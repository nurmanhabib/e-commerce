<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketDepartment extends Model 
{
	public $timestamps = false;
	protected $guarded = [];

	public function tickets()
	{
		return $this->belongsTo(Ticket::class);
	}
}