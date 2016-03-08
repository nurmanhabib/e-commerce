<?php

namespace App\Models;

use App\Models\User;
use App\Model\InvoiceDetails;
use App\Model\TransactionShipping;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	protected $guarder = [];
	
	public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detail_invoice()
    {
    	return $this->hasMany(InvoiceDetails::class);
    }

    public function transaction_address()
    {
        return $this->hasOne(TransactionShipping::class);
    }
}