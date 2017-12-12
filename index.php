<?php
require './vendor/autoload.php';

//IOC Container
$container = new \Kernel\Container();

//resolve request
//echo $container->resloveInstance('router')->handle(new \Kernel\Request());

echo 'Base path' . base_path().PHP_EOL;
echo 'Config path ' .config_path().PHP_EOL;
echo 'Kernel path' .kernel_path().PHP_EOL;


