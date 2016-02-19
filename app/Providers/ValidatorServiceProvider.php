<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 19/02/2016
 * Time: 17.04
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        app('validator')->extend('old_password', function($attribute, $value, $parameters, $validator) {
            $table  = array_get($parameters, 0);
            $uid    = array_get($parameters, 1);
            $field  = array_get($parameters, 2, $attribute);

            $found  = app('db')->from($table)->where('id', $uid)->first();

            if ($found) {
                if (app('hash')->check($value, $found->{$field})) {
                    return true;
                }
            }

            return false;
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // TODO: Implement register() method.
    }
}