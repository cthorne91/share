<?php

namespace App\Commands\Hosts;

use App\Services\Hosts\Contracts\Hosts;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class ListHosts extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'hosts:list';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Show a table of all registered hosts';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Hosts $hosts)
    {
        $list = collect($hosts->all())->map(function ($value, $key) {
            return [$key, $value];
        });

        $this->table(['Alias', 'Host'], $list);
    }
}
