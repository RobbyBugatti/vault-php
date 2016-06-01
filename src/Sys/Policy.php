<?php

namespace Vault\Sys;

class Policy
{
    public static function all()
    {
        $res = \Vault\Vault::call('sys/policy');
        return $res->body();
    }

    public static function get($policy)
    {
        $res = \Vault\Vault::call('sys/policy/'.$policy);
        return $res->body();
    }

    public static function create($policy, $args)
    {
        $res = \Vault\Vault::call('sys/policy/'.$policy, 'PUT', [], $args);
        return $res->body();
    }

    public static function update($policy, $args)
    {
        $res = \Vault\Vault::call('sys/policy/'.$policy, 'PUT', [], $args);
        return $res->body();
    }

    public static function delete($policy)
    {
        $res = \Vault\Vault::call('sys/policy/'.$policy, 'DELETE');
        return $res->body();
    }
}
