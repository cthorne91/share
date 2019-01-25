<?php

namespace App\Services\Hosts\Contracts;

interface Hosts
{
    public function add($alias, $host);

    public function remove($alias);

    public function find($alias);

    public function all();

    public function exists($alias);

    public function doesntExist($alias);
}
