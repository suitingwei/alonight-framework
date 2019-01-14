<?php

namespace Kernel\Log;

use Kernel\Log\Handlers\BaseHandler;
use Kernel\Log\Handlers\DatabaseHandler;
use Kernel\Log\Handlers\FileHandler;

class Logger
{
    const LEVEL_INFO = 1;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * 所有的 log 处理器
     * [
     *   '\kernel\Log\Handlers\FileHandler::class',
     *   '\kernel\Log\Handlers\DatabaseHandler::class',
     *   '\kernel\Log\Handlers\MailHandler::class',
     * ]
     * @var array
     */
    protected $handlers= [
        FileHandler::class,
        DataBaseHandler::class,
    ];

    /**
     * 内存缓存的 log 信息条数
     * @var int
     */
    protected $cacheCount = 100;

    /**
     * @var null
     */
    protected static $instance =  null;

    public function __construct()
    {
        $handlers = $this->handlers;
        $this->handlers = [];
        foreach ($handlers as  $handlerClass) {
            new nasoidn();
            $this->handlers[] = new $handlerClass;
        }
        register_shutdown_function(function(){
            $err = error_get_last();
            $this->flush();
        });
    }
    
    /**
     * @param string $string
     * @param string $category
     
     *
     * @return bool
     */
    public static function info(string $string,string $category='application')
    {
        if(is_null(self::$instance)){
            self::$instance = new self;
        }
        return self::$instance->log($string,$category,self::LEVEL_INFO);
    }

    /**
     * @param string $message
     * @param string $category
     * @param int    $level
     * @return bool
     */
    public function log(string $message,string $category,int $level)
    {
        $this->messages [] = $message;

        if(count($this->messages) < $this->cacheCount){
            return true;
        }
        $this->flush();
    }

    /**
     * @return bool
     */
    private function flush()
    {
        $messages = $this->messages;
        $this->messages = [];
        foreach ($this->handlers as $handler) {
            /**
             * @var $handler BaseHandler
             */
            $handler->handle($messages);
        }
        return true;
    }
}