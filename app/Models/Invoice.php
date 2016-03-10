<?php

namespace App\Models;

use App\Models\User;
use App\Models\InvoiceDetails;
use App\Models\TransactionShipping;
use App\Models\PaymentConfirmation;
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

    public function transaction_shipping()
    {
        return $this->hasOne(TransactionShipping::class);
    }

    // public function payment_confirmation()
    // {
    //     return $this->hasMany();
    // }
}