<?php

namespace Vault\Sys;

class Mount
{
    public static function all()
    {
        $res = \Vault\Vault::call('sys/mounts');
        return $res->body();
    }

    public function create($mount, $args)
    {
        $res = \Vault\Vault::call('sys/mounts/'.$mount, 'POST', [], $args, []);
        return $res->body();
    }

    public function tune($mount, $args)
    {
        $res = \Vault\Vault::call('sys/mounts/'.$mount.'/tune', 'POST', [], $args, []);
        return $res->body();
    }

    public function unmount($mount)
    {
        $res = Vault\Vault::call('sys/mounts/'.$mount, 'DELETE');
        return $res->body();
    }

    public function remount($to, $from)
    {
        $res = \Vault\Vault::call('sys/remount', 'POST', [], ['to' => $to, 'from' => $from], []);
        return $res->body();
    }
}
