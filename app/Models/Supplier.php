<?php

namespace App\Models;

use App\Models\Traits\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model implements SluggableInterface
{
    use SluggableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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

    protected $sluggable = [
        'build_from'    => 'name',
        'save_to'       => 'slug'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_supplier');
    }
}