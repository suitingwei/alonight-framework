<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/14
 * Time: 11:06
 */

require __DIR__ . '/../../vendor/autoload.php';

use Kernel\Http\RateLimiters\SimpleCounter;
use Kernel\Http\RateLimiters\Storage\RedisStorage;

testSimpleCounter();

function testSimpleCounter()
{
    $storage     = new RedisStorage();
    $rateLimiter = new SimpleCounter($storage);

    //Add the rate limit rules.
    $rateLimiter->addRule('DUMMY_URI', 5, 1);
    
    //
    for ($i = 0; $i < 10; $i++) {
//        echo sprintf("{$i}:\t%s\n",microtime(true));
        try {
            $rateLimiter->canProcess('DUMMY_URI');
        } catch (Exception $e) {
            die($e->getMessage());
        }
        //sleep 0.2 seconds
        usleep(100000);
    }
    
    print_r($rateLimiter->getStorage()->all());
}


readline();
