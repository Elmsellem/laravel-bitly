<?php

namespace Elmsellem\Bitly;

use Elmsellem\Bitly\Client\Bitly;
use Illuminate\Support\ServiceProvider;

class BitlyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('bitly', function () {
            return new Bitly(config('bitly.access_token'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        $configPath = $this->app->make('path.config');
        $this->publishes([__DIR__ . '/config/bitly.php' => $configPath . '/bitly.php']);
    }
}
