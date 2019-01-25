<?php

namespace App\Services\Secrets\Contracts;

interface Secrets
{
    public function all();

    public function find($name);

    public function getContents($name);

    public function remove($name);

    public function exists($name);

    public function doesntExist($name);
}
