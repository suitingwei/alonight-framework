<?php
namespace Kernel;


/**
 * Class Route
 * @package Kernel\Route
 */
class Router
{
    const METHOD_GET    = 'GET';
    const METHOD_POST   = 'POST';
    const METHOD_PUT    = 'PUT';
    const METHOD_DELETE = 'DELETE';

    /**
     * @var array
     */
    private $routes = [];

    public function __construct()
    {
    }

    /**
     * Register a get route.
     *
     * @param $pattern
     * @param $handle
     */
    public function get($pattern, $handle)
    {
        $this->addRoute(self::METHOD_GET, $pattern, $handle);
    }

    /**
     * @param $pattern
     * @param $handle
     */
    public function post($pattern, $handle)
    {
        $this->addRoute(self::METHOD_POST, $pattern, $handle);
    }

    /**
     * @param $pattern
     * @param $handle
     */
    public function delete($pattern, $handle)
    {
        $this->addRoute(self::METHOD_DELETE, $pattern, $handle);
    }

    /**
     * @param $pattern
     * @param $handle
     */
    public function put($pattern, $handle)
    {
        $this->addRoute(self::METHOD_PUT, $pattern, $handle);
    }

    /**
     * Register a new route.
     *
     * @param $method
     * @param $pattern
     * @param $handle
     */
    private function addRoute($method, $pattern, $handle)
    {
        if (!in_array($method, [self::METHOD_GET, self::METHOD_POST, self::METHOD_PUT, self::METHOD_DELETE])) {
            throw new Expection("{$method} is not supported.");
        }
        $this->routes[$method][$pattern] = $handle;
    }

    /**
     * Handle the http request.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        if(!isset($this->routes[$request->method()][$request->uri()])){
            throw new \Exception("Route Not Found! \n Method:{$request->method()} Uri:{$request->uri()} not exists");
        }

        $handle = $this->routes[$request->method()][$request->uri()];

        if ($handle instanceof \Closure) {
            return $handle();
        }

        list($controller, $method) = $this->getHandlerControllerAndMethod($handle);

        return (new $controller)->$method();
    }

    /**
     * Get the class of the handler controller.
     *
     * @param $handlerClass
     *
     * @return array
     */
    private function getHandlerControllerAndMethod($handlerClass)
    {
        list($controller, $method) = explode('@', $handlerClass);

        //TODO  use the config file.
        $controller = '\\App\\http\\controllers\\' . $controller;

        return [$controller, $method];
    }

}
