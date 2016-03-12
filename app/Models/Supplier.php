<?php

namespace App\Models;

use App\Supports\Contracts\Supplierable;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model implements Supplierable
{
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

    public static function boot()
    {
        parent::boot();

        Supplier::creating(function (Supplier $supplier) {
            $supplier->generateCode();
            $supplier->generateSlug();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_supplier');
    }

    public function scopeFindBySlug($query, $slug)
    {
        return $query->where('slug', $slug)->first();
    }

    public function generateCode()
    {
        $this->code = $this->createCode($this->name);

        return $this;
    }

    public function createCode($name, $numb = 0)
    {
        $code       = substr($name, $numb, 3);
        $already    = Supplier::where('code', $code)->first();

        if ($already)
            return $this->createCode($name, $numb+1);
            return $code;
    }

    public function generateSlug()
    {
        $this->slug = $this->createSlug($this->name);

        return $this;
    }

    public function createSlug($title, $numb = 0)
    {
        $slug       = str_slug($title, '-') . ($numb ? '-' . $numb : '');
        $already    = Supplier::findBySlug($slug);

        if ($already->count())
            return $this->createSlug($title, $numb+1);
            return $slug;
    }
}