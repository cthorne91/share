<?php

namespace App\Commands\Secrets;

use Spatie\Emoji\Emoji;
use App\Commands\Traits\LogsMissing;
use App\Services\Shell\Contracts\Shell;
use App\Services\Secrets\Contracts\Secrets;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class CopySecret extends Command
{
    use LogsMissing;

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'secrets:copy {name?} {--L|latest}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Copy a secret to the clipboard';

    protected $secrets;

    public function __construct(Secrets $secrets)
    {
        parent::__construct();

        $this->secrets = $secrets;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Secrets $secrets, Shell $shell)
    {
        $name = $this->getSecretName();

        if ($this->secrets->doesntExist($name)) {
            return $this->logMissing($name);
        }

        $this->secrets->find($name)->copyToClipboard();

        $this->info('Copied to clipboard ' . Emoji::smilingFaceWithSunglasses());
    }

    public function getSecretName()
    {
        if ($this->argument('name')) {
            return $this->argument('name');
        }
        
        return $this->secrets->all()->last()->getName();
    }
}
