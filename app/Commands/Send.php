<?php

namespace App\Commands;

use App\Services\SCP;
use App\Services\SSH;
use Spatie\Emoji\Emoji;
use App\Services\Hosts\Contracts\Hosts;
use App\Services\Shell\Contracts\Shell;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class Send extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'secret:with {alias} {content} {--file}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Sends a message to a host over ssh via scp';

    protected $files;

    protected $scp;

    protected $ssh;

    public function __construct(Storage $storage, SCP $scp, SSH $ssh)
    {
        parent::__construct();

        $this->files = $storage->disk('cwd');

        $this->scp = $scp;
        
        $this->ssh = $ssh;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Hosts $hosts)
    {
        if (! $this->validate()) {
            return;
        }

        $this->info(
            'Sending'. ($this->option('file') ? ' contents of file ' . $this->argument('content') : ' inline secret') . '...'
        );
        
        $name = $this->sendSecret(
            $this->getContent(),
            $hosts->find($this->argument('alias'))
        );

        $this->info('Sent ' . $name . ' ' . Emoji::rocket());
    }

    public function validate()
    {
        if ($this->option('file') && ! $this->files->exists($this->argument('content'))) {
            $this->error('file: ' . $this->argument('content') . ' does not exist');

            return false;
        }
        
        return true;
    }

    protected function sendSecret($content, $host)
    {
        $file = $this->scp->share($content)->with($host)->send();

        $command = $this->ssh->tell($host)->toExecute('"/usr/local/bin/share receive ' . $file.'"');

        return $file;
    }

    protected function getContent()
    {
        return $this->option('file')
            ? $this->files->get($this->argument('content'))
            : $this->argument('content');
    }
}
