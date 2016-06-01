<?php

namespace Vault\Tests;

class UserPassTest extends TestCase
{
    public function testLogin()
    {
        $user = 'rob_wittman';
        $pass = '2015ihsd';
        $res = \Vault\Auth::login('userpass', [
            'username' => $user,
            'password' => $pass
        ]);
        \Vault\Vault::setArg('token', $res->token());
        $this->assertInstanceOf('\Vault\User', $res);
    }

    public function testUpdatePassword()
    {
        $user = 'rob_wittman';
        $new_pass = '2015ihsd';
        $res = \Vault\Auth\Userpass::update_password($user, $new_pass);
    }

    public function testCreateUser()
    {
        $user = 'test_user';
        $pass = 'password';
        $res = \Vault\Auth\Userpass::create($user, $pass);
    }

    public function testList()
    {
        $users = \Vault\Auth\Userpass::all();
        var_dump($users);
    }
}
