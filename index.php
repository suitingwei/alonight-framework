<?php
require './vendor/autoload.php';

//IOC Container
try {
    $container = new \Kernel\Container();
} catch (\Kernel\Exceptions\InstanceAlreadyBoundException $e) {
    die($e) ;
}

//resolve request
//echo $container->resloveInstance('router')->handle(new \Kernel\Request());

\Kernel\Log\Logger::info('info message from index.php');


