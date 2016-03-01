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

$app->get('/', 'HomeController@index');

$app->group(['namespace' => 'App\Http\Controllers\Frontend\Auth'], function () use ($app) {
    $app->get('login', 'LoginController@user');
    $app->get('admin', 'LoginController@admin');
    $app->get('supplier', 'LoginController@supplier');
    $app->get('register', 'RegisterController@form');
    $app->get('reset-password/{token}', 'ReminderController@reset');
    $app->get('forgot-password', 'ReminderController@forgotPassword');
});

$app->group(['namespace' => 'App\Http\Controllers\Frontend\Admin', 'prefix' => 'admin'], function () use ($app) {
    $app->get('dashboard', 'DashboardController@index');
    $app->get('category', 'DashboardController@category');
});

$app->group(['namespace' => 'App\Http\Controllers\Frontend\Supplier', 'prefix' => 'supplier'], function () use ($app) {
    $app->get('products', 'SupplierController@index');
});
