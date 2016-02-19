<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 18/02/2016
 * Time: 16.32
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $timestamps = false;

    protected $guarded = [];
    protected $appends = ['full_name'];
    protected $touches = ['user'];

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}