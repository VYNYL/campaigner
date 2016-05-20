<?php

namespace Vynyl\Campaigner\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/campaigner.php';

        $this->publishes([
            $configPath => config_path('vynyl/campaigner.php')
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO: register app services
    }
}

