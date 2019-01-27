<?php

namespace App\Services\Hosts;

use App\Services\Json;
use App\Services\Hosts\Contracts\Hosts as HostContract;
use Illuminate\Contracts\Filesystem\Factory as Storage;

class HostsJson implements HostContract
{
    protected $files;

    const HOSTS_FILE = '/.share/hosts';

    public function __construct(Storage $storage, Json $json)
    {
        $this->files = $storage->disk('local');

        if (! $this->files->exists('/.share')) {
            $this->files->makeDirectory('/.share');
        }

        if (! $this->files->exists('/.share/hosts')) {
            $this->files->put('/.share/hosts', '{}');
        }

        $hosts = $this->files->exists(self::HOSTS_FILE)
            ? $this->files->get(self::HOSTS_FILE)
            : '{}';
        
        $this->json = $json->setJson($hosts);
    }
    
    public function add($alias, $host)
    {
        $this->files->put(
            self::HOSTS_FILE,
            $this->json->set($alias, $host)->toJson()
        );
    }

    public function remove($alias)
    {
        $this->files->put(
            self::HOSTS_FILE,
            $this->json->remove($alias)->toJson()
        );
    }

    public function find($alias)
    {
        return Json::withJson($this->files->get(self::HOSTS_FILE))->get($alias);
    }

    public function all()
    {
        return Json::withJson($this->files->get(self::HOSTS_FILE))->toArray();
    }

    public function exists($alias)
    {
        return Json::withJson($this->files->get(self::HOSTS_FILE))->has($alias);
    }

    public function doesntExist($alias)
    {
        return ! $this->exists($alias);
    }
}
