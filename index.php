<?php
require './vendor/autoload.php';

//IOC Container
try {
    $container = new \Kernel\Container();
    $rateLimiter = new \kernel\Http\RateLimiters\SimpleCounter();
    
    $rateLimiter->canProcess();
} catch (\Kernel\Exceptions\InstanceAlreadyBoundException $e) {
    die($e) ;
}

//resolve request
//echo $container->resloveInstance('router')->handle(new \Kernel\Request());

\Kernel\Log\Logger::info('info message from index.php');


