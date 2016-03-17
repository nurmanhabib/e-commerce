<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
	protected $guarded = [];
    protected $with = ['details'];
	
	public function buyer()
    {
        return $this->morphTo('buyerable');
    }

    public function details()
    {
    	return $this->hasMany(InvoiceDetails::class);
    }

    public function transaction_shipping()
    {
        return $this->belongsTo(TransactionShipping::class);
    }

    // public function payment_confirmation()
    // {
    //     return $this->hasMany();
    // }
}