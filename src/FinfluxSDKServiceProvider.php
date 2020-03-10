<?php

namespace KEBHanna\FinfluxSDK;

use Illuminate\Support\ServiceProvider;

class FinfluxSDKServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kebhanna');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kebhanna');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/finfluxsdk.php', 'finfluxsdk');

        // Register the service the package provides.
        $this->app->singleton('finfluxsdk', function ($app) {
            return new FinfluxSDK;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['finfluxsdk'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/finfluxsdk.php' => config_path('finfluxsdk.php'),
        ], 'finfluxsdk.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kebhanna'),
        ], 'finfluxsdk.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kebhanna'),
        ], 'finfluxsdk.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kebhanna'),
        ], 'finfluxsdk.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
