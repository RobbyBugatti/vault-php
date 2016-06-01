<?php

namespace Vault;

class Vault
{
    protected static $api_path          = '/v1/';
    protected static $host              = 'http://127.0.0.1';
    protected static $port              = 8200;
    protected static $instance          = NULL;
    protected static $exception_handler = 'exception';
    protected static $token             = NULL;

    public static function init(array $args = array())
    {
        $client = new \Vault\Http\Client();
        $api = new static($client);
        $api::setArg($args);
        static::setInstance($api);
        return $api;
    }

    public static function __callStatic($method, $args)
    {
        if(property_exists(__CLASS__, $method))
        {
            return self::$$method;
        }
        throw new \Exception("Call to undefined function {$method}");
    }

    public static function setArg($key, $value = NULL)
    {
        if(is_array($key))
        {
            foreach($key as $k => $v)
            {
                self::setArg($k, $v);
            }
        }
        else
        {
            if(!property_exists(__CLASS__, $key))
            {
                return;
            }
            self::$$key = $value;
        }
    }

    protected static function setInstance(\Vault\Vault $instance)
    {
        static::$instance = $instance;
    }

    public static function instance()
    {
        return static::$instance;
    }

    public static function call($url, $method = 'GET', $getVars = [], $postParams = [], $headers = [])
    {
        $url = self::$host.':'.self::$port.self::$api_path.$url;
        if(!is_null(self::token())) $headers['X-Vault-Token'] = self::token();
        $req = new \Vault\Http\Request($url, $method, $getVars, $postParams, $headers);
        $res = self::instance()->getClient()->send($req);
        return $res;
    }

    public static function seal()
    {
        $res = self::call('sys/seal', 'PUT', [], [], []);
        return $res->body();
    }

    public static function unseal($args)
    {
        $res = self::call('sys/unseal', 'PUT', [], $args, []);
        return $res->body();
    }

    public static function seal_status()
    {
        $res = self::call('sys/seal_status', 'GET');
        return $res->body();
    }

    public static function initialized()
    {
        $res = self::call('sys/init');
        return $res->body();
    }

    public static function create($args)
    {
        $res = self::call('sys/init', 'PUT', [], $args);
        return $res->body();
    }

    public static function health()
    {

    }
    
    protected function __construct($client)
    {
        $this->client = $client;
    }

    protected function getClient()
    {
        return $this->client;
    }

}
