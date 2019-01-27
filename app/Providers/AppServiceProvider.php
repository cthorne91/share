<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class AppServiceProvider extends ServiceProvider
{
    protected $directories = [
        '.share',
        '.share/tmp',
        '.share/secrets',
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Storage $storage)
    {
        $this->init($storage->disk('local'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function init($files)
    {
        collect($this->directories)->each(function ($dir) use ($files) {
            $files->makeDirectory($dir);
        });

        if (! $files->exists('/.share/hosts')) {
            $files->put('/.share/hosts', '{}');
        }
    }
}
