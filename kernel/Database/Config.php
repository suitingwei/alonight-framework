<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2018/11/6
 * Time: 11:26
 */

namespace Kernel\Database;


class Config
{
    public $user;
    public $password;
    public $host;
    public $port;
    public $driver;
    private $database;
    
    public static function create($database,$ip, $user, $password, $port = 3306)
    {
        $config           = new self;
        $config->host     = $ip;
        $config->user     = $user;
        $config->password = $password;
        $config->port     = $port;
        $config->database = $database;
        return $config;
    }
    
    public function generateDsnString()
    {
       return "mysql:host={$this->host};port={$this->port};dbname={$this->database}";
    }
}