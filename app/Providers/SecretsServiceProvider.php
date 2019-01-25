<?php

namespace App\Providers;

use App\Services\Secrets\SecretsFiles;
use Illuminate\Support\ServiceProvider;
use App\Services\Hosts\Contracts\Hosts as HostsContract;
use App\Services\Secrets\Contracts\Secrets as SecretsContract;

class SecretsServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SecretsContract::class, SecretsFiles::class);
    }
}
