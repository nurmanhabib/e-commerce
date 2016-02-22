<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return 'Amtek Ecommerce v1.0.0';
});

$app->post('register', 'V1\AuthController@register');

$api = app('Dingo\Api\Routing\Router');

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
            $api->group(['prefix' => 'user'], function () use ($api) {
                $api->post('change-password', 'AuthController@changePassword');
                $api->post('logout', 'AuthController@logout');
            });

            $api->post('profile', 'UserController@index');
            resource('tenants', 'TenantController', $api);
        });
    });
});
