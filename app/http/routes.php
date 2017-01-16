<?php

$router->get('/', 'HomeController@index');

$router->get('welcome', function () {
    return 'welcome page';
});


