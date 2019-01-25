<?php

namespace App\Providers;

use App\Services\Shell\Shell;
use Illuminate\Support\ServiceProvider;
use App\Services\Shell\Contracts\Shell as ShellContract;

class ShellServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ShellContract::class, function ($app) {
            return new Shell;
        });
    }
}
