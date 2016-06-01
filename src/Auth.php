<?php

namespace Vault;

use Vault\Vault;

class Auth
{
    protected $auth_type;
    protected $lease_id;
    protected $renewable;
    protected $lease_duration;
    protected $data;
    protected $auth;

    public static function login($type, $args)
    {
        switch(strtolower($type))
        {
            case 'userpass':
                $auth = \Vault\Auth\Userpass::authenticate($args);
            break;

            case 'token':

            break;

            case 'tls':

            break;

            case 'ldap':

            break;

            case 'mfa':

            break;

            case 'app':

            break;

            case 'github':

            break;

            default:
                throw new \Exception("Invalid authentication method {$type} supplied. Available types : [userpass,token,tls,ldap,mfa,app,github]");
        }

        return new \Vault\User($auth);
    }
}
