<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Supplier extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'slug', 
        'name', 
        'address_line_1', 
        'address_line_2',
        'phone_1',
        'phone_2',
        'email',
        'website',
        'tags'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_supplier');
    }
}