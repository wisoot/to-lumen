<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Gateways\ItemManagerGateway::class,
            \App\Services\Gateways\MySql\ItemManagerGateway::class
        );
    }
}
