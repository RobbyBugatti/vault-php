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
    }

    public function token()
    {
        return $this->auth->client_token;
    }
}
