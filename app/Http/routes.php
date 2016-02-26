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
    $app->get('login/social', 'Social\SocialController@login');
    $app->get('login', 'LoginController@user');
    $app->get('register', 'RegisterController@form');
    $app->get('reset-password/{token}', 'ReminderController@reset');
    $app->get('forgot-password', 'ReminderController@forgotPassword');
});

$app->group(['namespace' => 'App\Http\Controllers\Frontend\Admin', 'middleware' => 'auth.web', 'prefix' => 'admin'], function () use ($app) {
    $app->get('/', 'DashboardController@login');
    $app->get('dashboard', 'DashboardController@index');
    $app->get('category', 'CategoryController@index');
});
