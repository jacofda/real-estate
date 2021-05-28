<?php

namespace Areaseb\Estate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class EstateServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'estate');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'estate');

        $this->registerRoutes();

        if ($this->app->runningInConsole()) {



            // Publishing the translation.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang'),
            ], 'estate.trans');

            // Publishing the configs.
            $this->publishes([
              __DIR__.'/../config/core.php' => config_path('core.php'),
              __DIR__.'/../config/invoice.php' => config_path('invoice.php'),
              __DIR__.'/../config/fe.php' => config_path('fe.php'),
              __DIR__.'/../config/flare.php' => config_path('flare.php'),
          ], 'core.config');
        }
    }



    protected function registerRoutes()
    {
        Route::group(['middleware' => ['web', 'auth']], function () {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/estate.php', 'estate');

        // Register the service the package provides.
        $this->app->singleton('estate', function ($app) {
            return new Estate;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['estate'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/estate.php' => config_path('estate.php'),
        ], 'estate.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/areaseb'),
        ], 'estate.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/areaseb'),
        ], 'estate.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/areaseb'),
        ], 'estate.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
