<?php

namespace Kernel\Bootstrap;


class Logger
{

    public static function log($msg)
    {
        if(env())
       echo $msg;
    }
}