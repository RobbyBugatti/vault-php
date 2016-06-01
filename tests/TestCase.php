<?php

namespace Vault\Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \Vault\Vault::init();
    }
}
