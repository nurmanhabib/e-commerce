<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	public $timestamps = false;
	protected $fillable = ['name'];

	public static function boot()
	{
		parent::boot();

		Tag::creating(function (Tag $tag) {
			$tag->generateSlug();
		});
	}

	public function generateSlug()
	{
		$this->slug = $this->createSlug($this->name);

		return $this;
	}

	public function createSlug($name)
	{
		return str_slug($name);
	}

	public function products()
	{
		return $this->morphedByMany(Product::class, 'taggable');
	}
}