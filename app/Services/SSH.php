<?php

namespace App\Services;

use App\Services\Shell\Contracts\Shell;

class SSH
{
    protected $host;

    protected $shell;

    public function __construct(Shell $shell)
    {
        $this->shell = $shell;
    }
    
    public function tell($host)
    {
        $this->host = $host;

        return $this;
    }

    public function toExecute($command)
    {
        return $this->shell->execute("ssh $this->host " . $command);
    }
}
