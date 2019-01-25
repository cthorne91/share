<?php

namespace App\Commands;

use App\Services\Shell\Contracts\Shell;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Receive extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'receive {file}';

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
    public function handle(Shell $shell)
    {
        $this->notify("New secret received", $this->argument('file'));

        $shell->execute("open ~/.share/secrets/".$this->argument('file'));
    }
}
