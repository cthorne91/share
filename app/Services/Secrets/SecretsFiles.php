<?php

namespace App\Services\Secrets;

use App\Secret;
use App\Services\Secrets\Contracts\Secrets;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class SecretsFiles implements Secrets
{
    protected $files;

    public function __construct(Storage $storage)
    {
        $this->files = $storage->disk('local');

        if (! $this->files->exists('/.share')) {
            $this->files->makeDirectory('/.share');
        }

        if (! $this->files->exists('/.share/secrets/')) {
            $this->files->makeDirectory('/.share/secrets/');
        }
    }

    public function all()
    {
        return collect($this->files->allFiles('/.share/secrets/'))->mapInto(Secret::class);
    }

    public function find($name)
    {
        return new Secret("/.share/secrets/$name");
    }

    public function getContents($dir)
    {
        return $this->files->get($dir);
    }

    public function remove($dir)
    {
        $this->files->delete($dir);
    }

    public function exists($name)
    {
        return $this->files->exists("/.share/secrets/$name");
    }

    public function doesntExist($name)
    {
        return ! $this->exists($name);
    }
}
