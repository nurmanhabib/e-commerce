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

	public function createSlug($name, $numb = 0)
	{
		$slug       = str_slug($name, '-') . ($numb ? '-' . $numb : '');
        $already    = Tag::where('slug', $slug)->first();

        if (count($already) > 0)
            return $this->createSlug($name, $numb+1);
            return $slug;
	}

	public function products()
	{
		return $this->morphedByMany(Product::class, 'taggable');
	}
}