<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/1
 * Time: 16:32
 */
namespace Kernel\Log\Handlers;

abstract  class BaseHandler{

    /**
     * @param array $messages
     * @return mixed
     */
    abstract  public function handle(array $messages);
}