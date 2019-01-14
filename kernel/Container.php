<?php

namespace Kernel;

use ArrayAccess;
use Kernel\Error\ErrorHandler;
use Kernel\Exceptions\InstanceAlreadyBoundException;
use Kernel\Exceptions\InstanceNotFoundException;
use Kernel\Log\Logger;

/**
 * Class Container
 * @package Kernel
 */
class Container implements ArrayAccess
{
    private static $containerInstance = null;

    /**
     * @var array
     */
    private $instances = [];

    private $basePath   = '';
    private $kernelPath = '';
    private $configPath = '';

    private $configures = [];

    /**
     * Container constructor.
     * @throws InstanceAlreadyBoundException
     */
    public function __construct()
    {
        //必须先注册ErrorHandling，必然可能随后框架启动中的错误信息都会找不到
        $this->registerExceptionHandler();
        $this->registerPaths();
        $this->loadConfigureFiles();
        $this->registerHelpers();
        $this->registerRouter();
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

    public static function getInstance()
    {
        if (is_null(static::$containerInstance)) {
            return static::$containerInstance = new static();
        }

        return static::$containerInstance;
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
     * 绑定异常处理器
     * @throws InstanceAlreadyBoundException
     */
    public function registerExceptionHandler()
    {
        $handler = new ErrorHandler();
        $this->bindInstance('exception.handler', $handler);

        set_exception_handler([$handler, 'handleException']);
        set_error_handler([$handler, 'handleError']);
    }

    /**
     * Whether a offset exists
     * @link  http://php.net/manual/en/arrayaccess.offsetexists.php
     *
     * @param mixed $offset <p>
     *                      An offset to check for.
     *                      </p>
     *
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        // TODO: Implement offsetExists() method.
    }

    /**
     * Offset to retrieve
     * @link  http://php.net/manual/en/arrayaccess.offsetget.php
     *
     * @param mixed $offset <p>
     *                      The offset to retrieve.
     *                      </p>
     *
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        // TODO: Implement offsetGet() method.
    }

    /**
     * Offset to set
     * @link  http://php.net/manual/en/arrayaccess.offsetset.php
     *
     * @param mixed $offset <p>
     *                      The offset to assign the value to.
     *                      </p>
     * @param mixed $value <p>
     *                      The value to set.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    /**
     * Offset to unset
     * @link  http://php.net/manual/en/arrayaccess.offsetunset.php
     *
     * @param mixed $offset <p>
     *                      The offset to unset.
     *                      </p>
     *
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }

    private function registerPaths()
    {
        Logger::info('Register paths successfully...');
        $this->basePath   = realpath(__DIR__ . '/../');
        $this->configPath = realpath(__DIR__ . '/../config');
        $this->kernelPath = realpath(__DIR__ . '/../kernel');
    }

    private function registerHelpers()
    {
        require $this->kernelPath . '/helpers.php';
    }

    public function getBasePath()
    {
        return $this->basePath;
    }

    public function getKernelPath()
    {
        return $this->kernelPath;
    }

    public function getConfigPath()
    {
        return $this->configPath;
    }

    private function loadConfigureFiles()
    {

    }


}
