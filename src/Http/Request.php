<?php

namespace Vault\Http;

class Request
{
    protected $url;
    protected $getParams;
    protected $postParams;
    protected $headers;
    protected $method;
    protected $_default_headers = [
        'Content-Type' => 'application/json'
    ];

    public function __construct($url,
                                $method = 'GET',
                                $getParams = array(),
                                $postParams = array(),
                                $headers = array())
    {
        $this->url = $url;
        $this->method = $method;
        $this->getParams = $getParams;
        $this->postParams = $postParams;
        $this->headers = $headers;
    }

    public function headers()
    {
        $headers = $this->_default_headers;
        foreach($this->headers as $k => $v)
        {
            $headers[$k] = $v;
        }
        return $headers;
    }

    public function path()
    {
        $path = $this->url;
        if($this->method == 'GET')
        {
            $path = $path."?".http_build_query($this->getParams);
        }
        return $path;
    }

    public function params()
    {
        return $this->postParams;
    }

    public function method()
    {
        return $this->method;
    }
}
