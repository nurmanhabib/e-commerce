<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 17/02/2016
 * Time: 17.43
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }
}