<?php

namespace Vault\Http;

class Response
{
    protected $code;
    protected $body;
    protected $headers;

    public function __construct($body = NULL, $code = 200, $headers = array())
    {
        $this->body = $body;
        $this->code = $code;
        $this->headers = $headers;
    }

    public function body()
    {
        return json_decode($this->body);
    }

    public function rawBody()
    {
        return $this->body;
    }

    public function code()
    {
        return $this->code;
    }

    public function headers()
    {
        return $this->headers;
    }
}
