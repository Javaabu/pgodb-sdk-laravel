<?php

namespace Javaabu\PgoDbAPI;

use Illuminate\Support\ServiceProvider;
use Javaabu\PgoDB\PgoDB;
use Javaabu\PgoDbAPI\Commands\PgoDbAPICommand;

class PgoDbAPIServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(PgoDB::class, function () {
           $apiKey = $this->app['config']['pgodb.api_key'];
           $baseUri = $this->app['config']['pgodb.base_uri'];
           return new PgoDB($apiKey, $baseUri);
        });

        // Register the main class to use with the facade
        $this->app->singleton('pgodb-api', function () {
            return $this->app->make(PgoDB::class);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [PgoDB::class];
    }

}
