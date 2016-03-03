<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'activation_code', 'remember_token'
    ];

    protected $appends = [
        'active'
    ];

    protected $with = [
        'profile',
        'roles'
    ];

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasProfile()
    {
        return !empty($this->profile);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function hasActivationCode()
    {
        return !empty($this->activation_code);
    }

    public function isActive()
    {
        return !$this->hasActivationCode();
    }

    public function getActiveAttribute()
    {
        return $this->isActive() ? 1 : 0;
    }

    public function hasPassword()
    {
        return !empty($this->password);
    }

    public function supplier()
    {
        return $this->belongsToMany(Supplier::class, 'user_supplier');
    }
   
    public function shippingAddress()
    {
        return $this->hasMany(ShippingAddress::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
