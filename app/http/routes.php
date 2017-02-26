<?php


$router->get('/', 'HomeController@index');

$router->get('tests/caches', 'TestController@classObjectPropertyCache');


