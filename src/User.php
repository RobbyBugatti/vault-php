<?php

namespace Vault;

class User
{
    protected $lease_id;
    protected $renewable;
    protected $lease_duration;
    protected $data;
    protected $warnings;
    protected $auth;
    protected $policies;
    protected $metadata;

    public function __construct($args)
    {
        $this->lease_id = $args->lease_id;
        $this->renewable = $args->renewable;
        $this->lease_duration = $args->lease_duration;
        $this->data = $args->data;
        $this->warnings = $args->warnings;
        $this->auth = $args->auth;
        $this->policies = $args->auth->policies;
        $this->metadata = $args->auth->metadata;
        $this->data = $args;
    }

    public function token()
    {
        return $this->auth->client_token;
    }

    public function data()
    {
        return $this->data;
    }

    public function __get($var)
    {
        if(property_exists(__CLASS___, $var))
        {
            return $this->var;
        }
        throw new Exception("Undefined property User::{$var}");
    }
}
