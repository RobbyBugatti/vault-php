<?php

namespace Vault\Auth;

class Userpass
{
    public static function all()
    {
        $res = \Vault\Vault::call("auth/userpass", "LIST");
        return $res->body();
    }
    public static function authenticate($args)
    {
        $username = $args['username'];
        $password = $args['password'];
        $res = \Vault\Vault::call("auth/userpass/login/{$username}", 'POST', [], ['password' => $password]);
        return $res->body();
    }

    public static function create($username, $password, $policies = NULL, $ttl = NULL, $max_ttl = NULL)
    {
        $res = \Vault\Vault::call("auth/userpass/users/{$username}", 'POST', [], [
            'password' => $password,
            'policies' => $policies,
            'ttl' => $ttl,
            'max_ttl' => $max_ttl
        ]);
        return $res->body();
    }

    public static function update($username, $policies = NULL, $ttl = NULL, $max_ttl = NULL)
    {
        $res = \Vault\Vault::call("auth/userpass/users/{$username}", 'POST', [], [
            'policies' => $policies,
            'ttl' => $ttl,
            'max_ttl' => $max_ttl
        ]);
        return $res->body();
    }

    public static function update_password($username, $password)
    {
        $res = \Vault\Vault::call("auth/userpass/users/{$username}/password", 'POST', [], [
            'password' => $password
        ]);
        return $res->body();
    }

    public static function update_policies($username, $policies)
    {
        $res = \Vault\Vault::call("auth/userpass/users/{$username}/policies", 'POST', [], [
            'policies' => $policies,
        ]);
        return $res->body();
    }
}
