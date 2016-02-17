<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        User::creating(function (User $user) {
            $user->setPassword($user->password, false);
        });
    }

    public function createPassword($plain)
    {
        return app('hash')->make($plain);
    }

    public function setPassword($plain, $saved = true)
    {
        $this->password = $this->createPassword($plain);

        if ($saved)
            $this->save();

        return $this;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

//    public function tenants()
//    {
//        return $this->belongsToMany(Tenant::class, 'user_tenant');
//    }

    public function hasRole($slug)
    {
        $roles = $this->roles->filter(function ($role) use ($slug) {
            if (is_array($slug)) {
                foreach ($slug as $s) {
                    if ($role->slug === $s || $role->name === $s)
                        return true;
                }

                return false;
            } else {
                return $role->slug === $slug || $role->name === $slug;
            }
        });

        if ($roles->count()) {
            return true;
        } else {
            return false;
        }
    }
}
