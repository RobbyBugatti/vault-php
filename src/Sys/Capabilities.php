<?php

namespace Vault\Sys;

class Capability
{
    public static function get($token, $path)
    {
        $res = \Vault\Vault::call('sys/capabilites', 'POST', [], ['token' => $token, 'path' => $path]);
        return $res->body();
    }
}
