<?php

namespace Vault\Http;

class Client
{
    const TIMEOUT = 60;
    const CONNECT_TIMEOUT = 60;
    private $timeout = self::TIMEOUT;
    private $connect_timeout = self::CONNECT_TIMEOUT;

    public function __construct()
    {

    }

    public function send(\Vault\Http\Request $request)
    {
        $curl = curl_init();
        $method = strtolower($request->method());
        $opts = array();
        $headers = self::prepareHeaders($request->headers());

        $rheaders = array();
        $rheaders = array();
        $headerCallback = function ($curl, $header_line) use (&$rheaders) {
            // Ignore the HTTP request line (HTTP/1.1 200 OK)
            if (strpos($header_line, ":") === false) {
                return strlen($header_line);
            }
            list($key, $value) = explode(":", trim($header_line), 2);
            $rheaders[trim($key)] = trim($value);
            return strlen($header_line);
        };

        $url = $request->path();
        if($method == 'get')
        {
            $opts[CURLOPT_HTTPGET] = 1;
        }
        else if($method == 'post')
        {
            $opts[CURLOPT_POST] = 1;
            $opts[CURLOPT_POSTFIELDS] = json_encode($request->params());
        }
        else
        {
            $opts[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
        }
        $opts[CURLOPT_URL]              = $url;
        $opts[CURLOPT_RETURNTRANSFER]   = TRUE;
        $opts[CURLOPT_CONNECTTIMEOUT]   = $this->connect_timeout;
        $opts[CURLOPT_TIMEOUT]          = $this->timeout;
        $opts[CURLOPT_HEADERFUNCTION]   = $headerCallback;
        $opts[CURLOPT_HTTPHEADER]       = $headers;

        curl_setopt_array($curl, $opts);
        $res_body = curl_exec($curl);
        error_log($res_body);
        $errno = curl_errno($curl);
        $rcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if($res_body === false)
        {
            $message = curl_error($curl);
            throw new \Exception($message);
        }
        curl_close($curl);
        $this->handleHttpCode($rcode);
        // Create our response objecct
        $response = new Response($res_body, $rcode, $rheaders);

        return $response;
    }

    protected function handleHttpCode($code)
    {
        $msg = '';
        switch($code)
        {
            case 200:
            case 204:
                return;
            break;

            case 400:
                $msg = 'Invalid request, missing or invalid data. See the validation section for more details on the error response';
            break;

            case 403:
                $msg = 'Forbidden, your authentication detauls are either incorrec or you dontt have access to this feature';
            break;

            case 404:
                $msg = "Invalid path. This can both mean that the path truly doesn't exist or that you don't have permission to view a specific path. We use 404 in some cases to avoid state leakage.";
            break;

            case 429:
                $msg = "Rate limit exceeded. Try again after waiting some period of time.";
            break;

            case 500:
                $msg = "Internal server error. An internal error has occurred, try again later. If the error persists, report a bug.";
            break;

            case 503:
                $msg = "Vault is down for maintenance or is currently sealed. Try again later.";
            break;
        }

        // We now have an exception, let's handle it based on preffered options
        $handler = \Vault\Vault::exception_handler();
        if($handler == 'exception')
        {
            throw new \Exception($msg);
        }
        else if($handler == 'html')
        {
            $html = new \Vault\Handler\Html($code, $msg);
            $html->output();
            exit(1);
        }
        else if($handler == 'json')
        {
            // Create a new response object, not yet supported
        }
        else
        {
            // We ended up with a defined handler, so let's call it.
            $handler($code, $msg);
            // ......lol
        }
    }

    public static function prepareHeaders($headers)
    {
        $res = array();
        foreach($headers as $key => $value)
        {
            $res[] = "{$key}: {$value}";
        }
        return $res;
    }
}
