<?php

namespace Vault\Tests;

class RequestTest extends TestCase
{
    protected $obj;

    public function setUp()
    {
        $this->obj = new \Vault\Http\Request('http://google.com/test/path',
                                             'GET',
                                             ['test' => 1],
                                             ['secret' => NULL],
                                             ['X-Test-Header' => 'random_value']
        );
    }

    public function testGetMethod()
    {
        $this->assertEquals($this->obj->method(), 'GET');
    }

    public function testGetPath()
    {
        $this->assertEquals($this->obj->path(), 'http://google.com/test/path?test=1');
    }

    public function testGetHeaders()
    {
        $this->assertArrayHasKey('Content-Type', $this->obj->headers());
        $this->assertArrayHasKey('X-Test-Header', $this->obj->headers());
        $this->assertEquals($this->obj->headers()['X-Test-Header'], 'random_value');
    }
}
