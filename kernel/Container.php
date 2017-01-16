<?php
namespace Kernel;

use App\Exceptions\Handler;
use Kernel\Exceptions\InstanceAlreadyBoundException;
use Kernel\Exceptions\InstanceNotFoundException;

/**
 * Class Container
 * @package Kernel
 */
class Container
{
    /**
     * @var array
     */
    private $instances = [];

    /**
     * Container constructor.
     */
    public function __construct()
    {
        $this->registerRouter();
        $this->registerExceptionHandler();
    }

    /**
     *
     */
    private function registerRouter()
    {
        $router = new Router();
        require __DIR__ . '/../app/http/routes.php';
        $this->bindInstance('router', $router);
    }

    /**
     * @param $abstract
     * @param $instance
     *
     * @throws InstanceAlreadyBoundException
     */
    public function bindInstance($abstract, $instance)
    {
        if ($this->isInstanceExisted($abstract)) {
            throw new InstanceAlreadyBoundException("{$abstract} had already bound");
        }

        $this->instances[$abstract] = $instance;
    }

    /**
     * @param $abstract
     *
     * @return mixed
     * @throws InstanceNotFoundException
     */
    public function resloveInstance($abstract)
    {
        if (!$this->isInstanceExisted($abstract)) {
            throw new InstanceNotFoundException("{$abstract} not found");
        }

        return $this->instances[$abstract];
    }

    /**
     * @param $abstract
     *
     * @return bool
     */
    private function isInstanceExisted($abstract)
    {
        return array_key_exists($abstract, $this->instances);
    }

    /**
     *
     */
    public function registerExceptionHandler()
    {
        $handler = new Handler();
        $this->bindInstance('exception.handler', $handler);

        set_exception_handler([$handler, 'handleException']);
//        set_error_handler([$handler, 'handleError']);
    }



}
