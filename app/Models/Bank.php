<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AccountBank;

class Bank extends Model 
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'logo'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function account_banks()
    {
        return $this->hasMany(AccountBank::class);
    }
}