<?php

namespace App\Models;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Model;

class TransactionShipping extends Model
{
	protected $table = 'transaction_shippings';
	protected $guarded = [];

	public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}