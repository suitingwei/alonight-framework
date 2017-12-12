<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2017/10/27
 * Time: 10:46
 */
if(!function_exists('base_path')){
    function  base_path(){
        return app()->getBasePath();
    }
}

if(!function_exists('config_path')){
    function  config_path(){
        return app()->getConfigPath();
    }
}

if(!function_exists('kernel_path')){
    function  kernel_path(){
        return app()->getKernelPath();
    }
}


if(!function_exists('app')){
    /**
     * @return  \Kernel\Container
     */
    function  app(){
        return Kernel\Container::getInstance();
    }
}

if(!function_exists('env')){
   function env($key){
      return '';
   }
}
