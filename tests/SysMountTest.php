<?php

namespace Vault\Tests;

class SysMountTest extends TestCase
{
    public function testListMounts()
    {
        $mounts = \Vault\Sys\Mount::all();
    }

    public function testShowMount()
    {
    
    }
}
