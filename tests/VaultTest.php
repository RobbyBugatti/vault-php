<?php

namespace Vault\Tests;

class VaultTest extends TestCase
{
    public function setUp()
    {
        \Vault\Vault::init();
    }

    public function testSetPort()
    {
        \Vault\Vault::setArg('port', 3000);
        $this->assertEquals(\Vault\Vault::port(), 3000);
    }

    public function testSetHost()
    {
        \Vault\Vault::setArg('host', 'odin.ihslabs.com');
        $this->assertEquals(\Vault\Vault::host(), 'odin.ihslabs.com');
    }

    public function testSetToken()
    {
        $token = 'f3b09679-3001-009d-2b80-9c306ab81aa6';
        \Vault\Vault::setArg('token', $token);
        $this->assertEquals(\Vault\Vault::token(), $token);
    }
}
