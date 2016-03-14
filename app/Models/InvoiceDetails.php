<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
	protected $guarded = [];

    public function invoice()
    {
    	return $this->hasOne(Invoice::class);
    }
}