<?php

namespace App\Commands\Hosts;

use Spatie\Emoji\Emoji;
use App\Commands\Traits\LogsMissing;
use App\Services\Hosts\Contracts\Hosts;
use App\Services\Shell\Contracts\Shell;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class TestHost extends Command
{
    use LogsMissing;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'hosts:test {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Hosts $hosts, Shell $shell)
    {
        if ($hosts->doesntExist($this->argument('name'))) {
            return $this->logMissing($this->argument('name'));
        }

        $host = $hosts->find($this->argument('name'));

        $message = $shell->execute("ssh $host exit")->didSucceed()
            ? "Connection succeeded " . Emoji::shamrock()
            : "Failed to connect to " . $this->argument('name') . ' ' . Emoji::exclamationMark();

        $this->info($message);
    }
}
