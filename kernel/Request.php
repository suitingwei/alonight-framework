<?php
namespace Kernel;

/**
 * Class Request
 * @package Kernel
 */
class Request
{
    /**
     * Request constructor.
     */
    public function __construct()
    {
        //echo '\Kernel\Request has been instantiate';
    }

    /**
     * 请求方法
     * @return string
     */
    public function method()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    /**
     * 请求uri
     * @return string
     */
    public function uri()
    {
        $uri = $_SERVER['REQUEST_URI'];
        if ($uri == '/') {
            return $uri;
        }
        return trim($uri, '/');
    }

}
