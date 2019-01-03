<?php
require './vendor/autoload.php';

//IOC Container
//$container = new \Kernel\Container();

//resolve request
//echo $container->resloveInstance('router')->handle(new \Kernel\Request());

class User extends \Kernel\Database\Model
{
    protected $tableName = 'users';
    
}


fetchFromORM();

readline();

function fetchFromPDO()
{
    $pdo = new \PDO('mysql:host=localhost;dbname=test', 'root', 'root');
    
    $pdoStatement = $pdo->prepare('select * from users');
    
    $pdoStatement->execute();
    
    return $pdoStatement->fetchAll(PDO::FETCH_BOTH);
}

function fetchFromORM()
{
    $dsnConfig=  \Kernel\Database\Config::create('test','localhost','root','root');
    
    //假设一个 Model 可以如此直接查询，那么他需要一个默认的 DSN 链接,所以 Model 一定要有一个方法能够向 Model 中设置 DSN
    return User::useConfig($dsnConfig)->find()->all();
}

function fetchFromPDOWithConnection(){
    
    $pdo = new \PDO('mysql:host=localhost;dbname=test', 'root', 'root');
    
    $pdoStatement = $pdo->prepare('select * from users');
    
    $pdoStatement->execute();
    
    $result1= $pdoStatement->fetchAll(PDO::FETCH_BOTH);
    
    print_r($result1);
    
    
    $pdoStatement->execute();
    
    $result2= $pdoStatement->fetchAll(PDO::FETCH_BOTH);
    
    print_r($result2);
    
    sleep(50);
}
