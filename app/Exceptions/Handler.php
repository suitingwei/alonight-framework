<?php
namespace App\Exceptions;

/**
 * Class Handler
 * @package App\Exceptions
 */
/**
 * Class Handler
 * @package App\Exceptions
 */
class Handler
{
    /**
     * @param \Exception $exception
     */
    public function handleException($exception)
    {
        echo <<<EXCEPTION
        <html>
       <h1>{$exception->getMessage()}</h1>
<pre>{$exception->getTraceAsString()}</pre>
</html>
EXCEPTION;
        exit(1);
    }

    /**
     * @param \Error $error
     */
    public function handleError(\Error $error)
    {
        echo <<<EXCEPTION
        <html>
<pre>{$error->getTraceAsString()}</pre>
</html>
EXCEPTION;
        exit(1);
    }
}
