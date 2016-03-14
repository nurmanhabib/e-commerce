<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Banks;
use App\Models\Supplier;

class AccountBanks extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_name',
        'account_number',
        'bank_id',
        'supplier_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    protected $with = [
        'bank',
        'supplier',
    ];

    public function bank()
    {
        return $this->belongsTo(Banks::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}