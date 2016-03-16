<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Testimonial extends Model 
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject',
        'testimonial',
        'point_speed',
        'point_quality',
        'point_package',
        'product_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    protected $with = [
        'product'
    ];

	protected $guarded = [];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}