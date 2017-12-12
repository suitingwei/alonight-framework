<?php
namespace Kernel\Utils;

/**
 * Class Config
 * @package Kernel\Utils
 */
class Config
{

    /**
     * @return  array
     */
    public static function getConnectionDsn()
    {
        return (require __DIR__ . '/../../app/config/database.php');
    }
}
