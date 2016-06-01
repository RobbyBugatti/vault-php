<?php

namespace Vault\Tests;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        \Vault\Vault::init();
        \Vault\Vault::setArg('token', '227adc53-ac16-b50f-2614-61693ddade0b');
    }
}
