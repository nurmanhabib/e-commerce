<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
	protected $guarder = [];

    public function detail_invoice()
    {
    	return $this->hasOne(Invoice::class);
    }
}