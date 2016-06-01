<?php

namespace Vault\Tests;

class VaultTest extends TestCase
{
    public function testSetPort()
    {
        \Vault\Vault::setArg('port', 8200);
        $this->assertEquals(\Vault\Vault::port(), 8200);
    }

    public function testSetHost()
    {
        \Vault\Vault::setArg('host', 'http://127.0.0.1');
        $this->assertEquals(\Vault\Vault::host(), 'http://127.0.0.1');
    }

    public function testSetToken()
    {
        $token = 'f3b09679-3001-009d-2b80-9c306ab81aa6';
        \Vault\Vault::setArg('token', $token);
        $this->assertEquals(\Vault\Vault::token(), $token);
    }

    public function testSealStatus()
    {
        $status = \Vault\Vault::seal_status();
    }
}
