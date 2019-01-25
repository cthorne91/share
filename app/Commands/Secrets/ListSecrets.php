<?php

namespace App\Commands\Secrets;

use App\Services\Secrets\Contracts\Secrets;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class ListSecrets extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'secrets:list';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show all secrets';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Secrets $secrets)
    {
        $list = $secrets->all()->map(function ($secret) {
            return [$secret->getName(), str_limit($secret->getContents(), 80)];
        });


        $this->table(['Name', 'Contents'], $list);
    }
}
