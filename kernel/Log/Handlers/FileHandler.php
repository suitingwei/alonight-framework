<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/1
 * Time: 16:32
 */
namespace Kernel\Log\Handlers;

class FileHandler  extends  BaseHandler {

    /**
     * @param array $messages
     * @return mixed
     */
    public function handle(array $messages)
    {
        file_put_contents('/tmp/alonight-framework.log',implode("\n",$messages),FILE_APPEND);
    }
}