<?php

namespace App\Commands\Hosts;

use Spatie\Emoji\Emoji;
use App\Services\Hosts\Contracts\Hosts;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class AddHost extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'hosts:add {alias} {host}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Add a host alias';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Hosts $hosts)
    {
        $hosts->add(
            $this->argument('alias'),
            $this->argument('host')
        );

        $this->info($this->argument('alias') . ' has been added ' . Emoji::whiteHeavyCheckMark());
    }
}
