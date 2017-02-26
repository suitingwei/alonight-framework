<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2017/1/15
 * Time: 下午8:26
 */

namespace Kernel\Utils;

/**
 * Class StringUtil
 * @package Kernel\Database
 */
class StringUtil
{
    /**
     * @param $string
     * @param $delimeter
     *
     * @return string
     */
    public static function last($string, $delimeter)
    {
        if (($lastPosition = strrpos($string, $delimeter)) === false) {
            return $string;
        }

        return substr($string, $lastPosition+1);
    }
}