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

$app->group(['namespace' => 'Auth'], function () {
    $app->get('login', 'LoginController@form');
    $app->get('register', 'RegisterController@form');
    $app->get('reminder', 'ReminderController@create');
    $app->get('reminder/{token}', 'ReminderController@reset');
});
