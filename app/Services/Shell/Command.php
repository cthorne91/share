<?php

namespace App\Services\Shell;

use App\Services\Shell\Contracts\Shell;

class Command
{
    protected $command;

    protected $lines;

    protected $statusCode;
    
    public function __construct($command, $lines, $code)
    {
        $this->command =  $command;

        $this->lines = $lines;

        $this->statusCode = $code;
    }

    public static function make($command)
    {
        return new static($command);
    }

    public function execute()
    {
        return app(Shell::class)->execute($this->command);
    }

    public function getCommand()
    {
        return $this->command;
    }

    public function didSucceed()
    {
        return $this->statusCode == 0;
    }

    public function didFail()
    {
        return ! $this->didSucceed();
    }
}
