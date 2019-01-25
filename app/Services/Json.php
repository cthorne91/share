<?php

namespace App\Services;

class Json
{
    protected $data;

    public function __construct($json = null)
    {
        $this->data = $json ? json_decode($json, true) : null;
    }

    public static function withJson($json)
    {
        return new static($json);
    }

    public function withArray(array $array)
    {
        return new static(json_encode($array));
    }

    public function setJson($json)
    {
        $this->data = json_decode($json, true);

        return $this;
    }

    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function get($key)
    {
        return $this->data[$key];
    }

    public function has($key)
    {
        return array_key_exists($key, $this->data);
    }

    public function remove($key)
    {
        unset($this->data[$key]);

        return $this;
    }

    public function toJson()
    {
        return json_encode($this->data);
    }

    public function toArray()
    {
        return $this->data;
    }
}
