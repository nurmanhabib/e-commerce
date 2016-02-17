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

$api = app('Dingo\Api\Routing\Router');

function resource($path, $controller, &$api)
{
    $api->get($path, $controller . '@index');
    $api->get($path . '/{id}', $controller . '@show');
    $api->put($path . '/{id}', $controller . '@update');
    $api->delete($path . '/{id}', $controller . '@destroy');
}

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\V1', 'prefix' => 'v1'], function () use ($api) {
        $api->group(['prefix' => 'auth'], function () use ($api) {
            $api->post('register', 'AuthController@register');
            $api->post('login', 'AuthController@login');
            $api->get('cek', function () {
                return \Illuminate\Support\Facades\Auth::user();
            });
        });

        $api->group(['middleware' => 'auth'], function () use ($api) {
            $api->group(['prefix' => 'auth'], function () use ($api) {
                $api->get('change-password', 'AuthController@changePassword');
                $api->get('logout', 'AuthController@logout');
            });
            $api->get('tes', function () {
                return 'tes';
            });

            resource('tenants', 'TenantController', $api);
        });
    });
});
