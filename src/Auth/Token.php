<?php

namespace Vault\Auth;

class Token
{
    public static function create()
    {

    }

    public static function create_orphan()
    {

    }

    public static function create_for_role()
    {

    }

    public static function lookup($token = NULL)
    {
        if(is_null($token))
        {
            $url = 'auth/token/lookup-self';
        }
        else
        {
            $url = 'auth/token/lookup/'.$token;
        }
        $res = \Vault\Vault::call($url, 'GET');
        return $res->body();
    }

    public static function renew($token = NULL)
    {
        if(is_null($token))
        {
            $url = 'auth/token/renew-self';
        }
        else
        {
            $url = 'auth/token/renew/'.$token;
        }
        $res = \Vault\Vault::call($url, 'GET');
        return $res->body();
    }

    public static function revoke($token)
    {
        if(is_null($token))
        {
            $url = 'auth/token/revoke-self';
        }
        else
        {
            $url = 'auth/token/revoke/'.$token;
        }
        $res = \Vault\Vault::call($url, 'POST');
        return $res->body();
    }

    public static function revoke_orphan($token)
    {
        $res = \Vault\Vault::call('auth/token/revoke-orphan/'.$token, 'POST');
        return $res->body();
    }

    public static function revoke_prefix($prefix)
    {
        $res = \Vault\Vault::call('auth/token/revoke-prefix/'.$prefix, 'POST');
        return $res->body();
    }
}
