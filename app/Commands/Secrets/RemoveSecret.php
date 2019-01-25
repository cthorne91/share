<?php

namespace App\Commands\Secrets;

use Spatie\Emoji\Emoji;
use App\Commands\Traits\LogsMissing;
use App\Services\Secrets\Contracts\Secrets;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class RemoveSecret extends Command
{
    use LogsMissing;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'secrets:remove {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Remove a secret';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Secrets $secrets)
    {
        if ($secrets->doesntExist($this->argument('name'))) {
            return $this->logMissing($this->argument('name'));
        }

        $secrets->find($this->argument('name'))->delete();

        $this->info('Secret has been destroyed ' . Emoji::collision());
    }
}
