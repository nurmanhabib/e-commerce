<?php

function resource($path, $controller, &$api)
{
    $api->post($path, $controller . '@index');
    $api->post($path . '/{id}', $controller . '@show');
    $api->put($path . '/{id}', $controller . '@update');
    $api->delete($path . '/{id}', $controller . '@destroy');
}

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\V1', 'prefix' => 'v1'], function () use ($api) {

        /* AUTHENTICATION */
        $api->group(['namespace' => 'Auth', 'prefix' => 'auth'], function () use ($api) {
            // Register
            $api->post('register-email', 'RegisterController@emailOnly');
            $api->post('register', 'RegisterController@register');

            // Login (or get JWToken)
            $api->post('login', 'LoginController@login');

            // Reminder Password (or reset password)
            $api->post('create-reset-password', 'Auth\ResetPasswordController@create');
            $api->post('reset-password', 'Auth\ResetPasswordController@reset');
        });

        /* ROLE: ADMIN */
        $api->group(['namespace' => 'Admin', 'middleware' => ['auth', 'role:admin'], 'prefix' => 'admin'], function () use ($api) {
            resource('users', 'UserController', $api);
            resource('suppliers', 'SupplierController', $api);
            resource('products', 'ProductController', $api);
        });

        /* ROLE: SUPPLIER */
        $api->group(['middleware' => 'auth'], function () use ($api) {
            $api->group(['namespace' => 'User', 'prefix' => 'user'], function () use ($api) {
                $api->get('profile', 'ProfileController@show');
                $api->put('profile', 'ProfileController@update');
                $api->put('change-password', 'ProfileController@changePassword');
            });

            $api->post('profile', 'UserController@index');

            resource('suppliers', 'SupplierController', $api);
            resource('products', 'ProductController', $api);
        });
    });
});
