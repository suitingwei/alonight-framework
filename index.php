<?php
require './vendor/autoload.php';

use Kernel\Request;
use Kernel\Route;

$request = new Request();

$route = new Route();

$route->get('/',function(){
    return 'asd';
});
$route->get('welcome',function(){
    return 'welcome page';
});

echo $route->handle($request);

