<?php

namespace striebwj\HorizonStats;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../config/horizon-stats.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('horizon-stats.php'),
        ], 'config');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'horizon-stats'
        );
    }
}
