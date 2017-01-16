<?php
namespace Kernel\Database;

use Kernel\Utils\Config;
use Kernel\Utils\StringUtil;

/**
 * Class Model
 * @package Kernel\Database
 */
class Model
{
    /**
     * @var \PDO
     */
    private $connection;

    private static $instance;

    private $tableName = 'Model';

    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->_initConnection();
        $this->_initTableName();
    }

    public function _initTableName()
    {
        $this->tableName = StringUtil::last(get_class(), '\\');
    }

    /**
     *
     */
    private function _initConnection()
    {
        $connectionConfig = Config::getConnectionDsn();

        $dsnString        = <<<DSN
{$connectionConfig['driver']}:dbname={$connectionConfig['connection']['dbname']};
host={$connectionConfig['connection']['host']};
DSN;
        $this->connection = new \PDO($dsnString, $connectionConfig['connection']['user'],
            $connectionConfig['connection']['passwd']);
    }

    /**
     *
     */
    public static function __callStatic($method, $parameters)
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance->$method($parameters);
    }


    public function all()
    {
        $statement = $this->connection->query("select * from users");

        return $statement->fetchAll(\PDO::FETCH_CLASS,'stdClass');
    }
}
