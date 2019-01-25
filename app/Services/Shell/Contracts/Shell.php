<?php

namespace App\Services\Shell\Contracts;

interface Shell
{
    /**
     * Execute the command
     *
     * @param string|\App\Services\Shell\Command $command
     * @return void
     */
    public function execute($command);

    /**
     * Get an array of commands previously run
     *
     * @return array [\App\Services\Shell\Command];
     */
    public function getHistory();
}
