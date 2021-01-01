<?php

namespace Munzevi\Passcon;

use Illuminate\Support\ServiceProvider;

class PassconServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'passcon');
        // #$this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'passcon');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('passcon.php'),
            ], 'passcon-config-files');

            $this->publishes([
                __DIR__.'/../translations' => resource_path('lang/vendor/passcon'),
            ], 'passcon-lang-files');

            $this->publishes([
                __DIR__.'/../database/migrations' => app_path('../database/migrations'),
            ], 'passcon-migrations');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/passcon'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/passcon'),
            ], 'assets');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'passcon');

        // Register the main class to use with the facade
        $this->app->singleton('passcon', function () {
            return new Passcon;
        });
    }
}
