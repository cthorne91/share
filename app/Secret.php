<?php

namespace App;

use App\Services\Shell\Contracts\Shell;
use App\Services\Secrets\Contracts\Secrets;

class Secret
{
    protected $dir;

    public function __construct($dir)
    {
        $this->dir = $dir;
    }

    public function delete()
    {
        app(Secrets::class)->remove($this->dir);
    }

    public function getContents()
    {
        return app(Secrets::class)->getContents($this->dir);
    }

    public function getName()
    {
        return collect(explode('/', $this->dir))->last();
    }

    public function copyToClipboard()
    {
        $contents = $this->getContents();

        app(Shell::class)->execute("echo \"$contents\" | pbcopy");

        return $this;
    }
}
