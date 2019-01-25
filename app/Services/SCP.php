<?php

namespace App\Services;

use App\Services\Shell\Contracts\Shell;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class SCP
{
    const TEMP_DIR = '/.share/tmp';

    protected $content;

    protected $to;

    protected $files;

    protected $shell;

    protected $fileName;

    protected $fileDir;

    public function __construct(Storage $storage, Shell $shell)
    {
        $this->files = $storage->disk('local');

        $this->shell = $shell;

        $this->fileName = date('Ymd').str_random(5);

        $this->fileDir = self::TEMP_DIR.'/'. $this->fileName;
    }

    public function share($content)
    {
        $this->content = $content;

        return $this;
    }

    public function with($to)
    {
        $this->to = $to;

        return $this;
    }

    public function send()
    {
        $this->files->put($this->fileDir, $this->content);

        $command = tap($this->shell->execute($this->getCommand()), function () {
            $this->files->delete($this->fileDir);
        });

        if ($command->didFail()) {
            throw new \Exception('There was an scp error');
        }

        return $this->fileName;
    }

    protected function getCommand()
    {
        $this->files->put($this->fileDir, $this->content);

        return "scp ~{$this->fileDir} {$this->to}:~/.share/secrets/";
    }
}
