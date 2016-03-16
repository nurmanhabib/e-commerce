<?php

require_once __DIR__.'/../vendor/autoload.php';

try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

$app->withFacades();
$app->withEloquent();

$app->configure('jwt');
$app->configure('mail');
$app->configure('amtekcommerce');

class_alias(Tymon\JWTAuth\Facades\JWTAuth::class, 'JWTAuth');
class_alias(Illuminate\Support\Facades\Mail::class, 'Mail');

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton('notification', function () {
    return new Notification;
});

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

$app->middleware([
    App\Http\Middleware\CorsMiddleware::class,
]);

$app->routeMiddleware([
    'cors' => App\Http\Middleware\CorsMiddleware::class,
    'auth' => App\Http\Middleware\Authenticate::class,
    'auth.web' => App\Http\Middleware\AuthenticateWeb::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$app->register(App\Providers\AppServiceProvider::class);
$app->register(App\Providers\AuthServiceProvider::class);
$app->register(App\Providers\CatchAllOptionsRequestsProvider::class);
$app->register(App\Providers\EventServiceProvider::class);
$app->register(App\Providers\ValidatorServiceProvider::class);
$app->register(Dingo\Api\Provider\LumenServiceProvider::class);
$app->register(Illuminate\Mail\MailServiceProvider::class);
$app->register(Prettus\Repository\Providers\LumenRepositoryServiceProvider::class);
$app->register(Tymon\JWTAuth\Providers\JWTAuthServiceProvider::class);
$app->register(App\Providers\SupplierServiceProvider::class);
$app->register(Nurmanhabib\Kewilayahan\KewilayahanLumenServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers\Frontend'], function ($app) {
    $namespace  = 'App\Http\Controllers\Frontend';
    $prefix     = '';
    $group      = compact('namespace', 'prefix');

    require __DIR__.'/../app/Http/routes.php';
});

$app->group(['namespace' => 'App\Http\Controllers\V1', 'middleware' => ['cors'], 'prefix' => 'api/v1'], function ($app) {
    $namespace  = 'App\Http\Controllers\V1';
    $middleware = ['cors'];
    $prefix     = 'api/v1';
    $group      = compact('namespace', 'middleware', 'prefix');
    $api        = app(Dingo\Api\Routing\Router::class);

    $api->version('v1', function ($api) use ($namespace, $middleware, $prefix, $group) {
        $api->group(['namespace' => $namespace, 'middleware' => $middleware, 'prefix' => 'v1'], function ($api) use ($namespace, $middleware, $prefix, $group) {
            require __DIR__.'/../app/Http/api.php';
        });
    });
});

return $app;
