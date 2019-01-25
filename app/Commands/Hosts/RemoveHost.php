<?php

namespace App\Commands\Hosts;

use Spatie\Emoji\Emoji;
use App\Commands\Traits\LogsMissing;
use App\Services\Hosts\Contracts\Hosts;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class RemoveHost extends Command
{
    use LogsMissing;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'hosts:remove {alias}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Removes a host alias';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Hosts $hosts)
    {
        if ($hosts->doesntExist($this->argument('alias'))) {
            return $this->logMissing($this->argument('alias'));
        }

        $hosts->remove($this->argument('alias'));

        $this->info($this->argument('alias') . ' has been removed ' . Emoji::collision());
    }
}
