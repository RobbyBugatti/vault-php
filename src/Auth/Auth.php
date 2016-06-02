<?php

namespace Vault\Auth;

class Auth
{
    public static function all()
    {
        $res = \Vault\Vault::call('sys/auth');
        return $res->body();
    }
}
