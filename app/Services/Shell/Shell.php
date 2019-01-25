<?php

namespace App\Services\Shell;

use App\Services\Shell\Command;
use App\Services\Shell\Contracts\Shell as ShellInterface;

class Shell implements ShellInterface
{
    protected $history = [];

    /**
     * Execute the command on the command line.
     *
     * @param string $command
     * @return Command
     */
    public function execute($command)
    {
        $lines = [];
        $statusCode = 0;
        exec($command, $lines, $statusCode);

        return tap(new Command($command, $lines, $statusCode), function ($command) {
            $this->history[] = $command;
        });
    }

    public function getHistory()
    {
        return $this->history;
    }
}
