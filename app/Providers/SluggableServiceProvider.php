<?php
/**
 * Created by PhpStorm.
 * User: ilma
 * Date: 22/02/2016
 * Time: 17.55
 */

namespace App\Providers;

use App\Models\SluggableInterface;
use Illuminate\Support\ServiceProvider;

class SluggableServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->handleConfigs();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerEvents();
    }

    /**
     * Register the configuration.
     */
    private function handleConfigs()
    {
        $configPath = config_path('sluggable.php');
        $this->mergeConfigFrom($configPath, 'sluggable');
    }

    /**
     * Register the listener events
     *
     * @return void
     */
    public function registerEvents()
    {
        $this->app['events']->listen('eloquent.saving*', function ($model) {
            if ($model instanceof SluggableInterface) {
                $model->sluggify();
            }
        });
    }
}