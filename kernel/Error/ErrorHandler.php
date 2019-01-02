<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/1
 * Time: 16:06
 */

namespace Kernel\Error;

class ErrorHandler
{
    public function handleError($code,$message)
    {
        var_dump($code,$message);die('error occurred');
    }

    public function handleException($exception)
    {
        var_dump((string)$exception);die('exception occurred');
    }
}