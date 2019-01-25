<?php

namespace App\Commands;

use Spatie\Emoji\Emoji;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class Init extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'init';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create all of the nessesary directories';

    protected $files;

    protected $directories = [
        '.share',
        '.share/tmp',
        '.share/secrets',
    ];

    public function __construct(Storage $storage)
    {
        $this->files = $storage->disk('local');

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        collect($this->directories)->each(function ($dir) {
            $this->files->makeDirectory($dir);
        });

        $this->info('Share utility initialized successfully ' . Emoji::rocket());
    }
}
