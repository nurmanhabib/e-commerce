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
    // Login
    $app->get('login', 'LoginController@user');
    $app->get('admin/login', 'LoginController@admin');
    $app->get('supplier/login', 'LoginController@supplier');
    $app->get('login/social/{driver}', 'Social\SocialController@login');

    // Register
    $app->get('supplier/register', 'RegisterController@registerSupplier');
    $app->get('supplier/register/{activation_code}', 'RegisterController@activateSupplier');
    $app->get('register', 'RegisterController@registerMember');
    $app->get('register/{activation_code}', 'RegisterController@activate');

    // Forgot Password
    $app->get('reset-password/{token}', 'ReminderController@reset');
    $app->get('forgot-password', 'ReminderController@forgotPassword');
});

$app->group(['namespace' => 'App\Http\Controllers\Frontend\Admin', 'prefix' => 'admin'], function () use ($app) {
    $app->get('/', 'DashboardController@index');
    $app->get('category', 'CategoryController@index');
    $app->get('product', 'ProductController@index');
    $app->get('supplier', 'SupplierController@index');
    $app->get('config', 'ConfigController@index');
});

$app->group(['namespace' => 'App\Http\Controllers\Frontend\Supplier', 'prefix' => 'supplier'], function () use ($app) {
    $app->get('products', 'SupplierController@index');
});
