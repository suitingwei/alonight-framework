<?php
require './vendor/autoload.php';

//IOC Container
$container = new \Kernel\Container();

//resolve request
echo $container->resloveInstance('router')->handle(new \Kernel\Request());

