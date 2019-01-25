<?php

namespace App\Commands;

use App\Services\Shell\Contracts\Shell;
use App\Services\Secrets\Contracts\Secrets;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Receive extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'receive {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Save the file to the vault';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Shell $shell, Secrets $secrets)
    {
        $this->notify("New secret received", $this->argument('name'));

        $secrets->find($this->argument('name'))->copyToClipboard();
    }
}
