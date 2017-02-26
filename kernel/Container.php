<?php
namespace Kernel;

use App\Exceptions\Handler;
use ArrayAccess;
use Kernel\Exceptions\InstanceAlreadyBoundException;
use Kernel\Exceptions\InstanceNotFoundException;

/**
 * Class Container
 * @package Kernel
 */
class Container implements ArrayAccess
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
     * @param mixed $value  <p>
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
}
