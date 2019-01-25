<?php

namespace App\Providers;

use App\Services\Hosts\HostsJson;
use Illuminate\Support\ServiceProvider;
use App\Services\Hosts\Contracts\Hosts as HostsContract;

class HostsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HostsContract::class, HostsJson::class);
    }
}
