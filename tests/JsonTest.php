<?php

namespace Tests;

use App\Services\Json;

class JsonTest extends TestCase
{
    public function testJsonManipulation()
    {
        $json = Json::withJson('{"key":"value"}');

        $this->assertEquals('{"key":"value"}', $json->toJson());
        $json->set('foo', 'bar');
        $this->assertEquals('{"key":"value","foo":"bar"}', $json->toJson());
        $this->assertEquals('bar', $json->get('foo'));
        $json->remove('key');
        $this->assertEquals('{"foo":"bar"}', $json->toJson());
        $json->setJson('{"fiz":"faz"}');
        $this->assertEquals('{"fiz":"faz"}', $json->toJson());
    }
}
