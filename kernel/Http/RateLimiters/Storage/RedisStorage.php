<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/14
 * Time: 11:13
 */

namespace Kernel\Http\RateLimiters\Storage;

use Redis;

class RedisStorage implements StorageInterface
{
    /**
     * @var Redis
     */
    private static $redisInstance = null;
    
    public function __construct()
    {
        if (!is_null(static::$redisInstance)) {
            return static::$redisInstance;
        }
        
        return $this->initRedis();
    }
    
    private function initRedis()
    {
        $redis = new Redis();
        $redis->connect('127.0.0.1');
        
        static::$redisInstance = $redis;
        
        return true;
    }
    
    /**
     * Save the current request uri into the container.
     *
     * @param     $uri
     *
     * @param int $ttl
     *
     * @return bool
     */
    public function store($uri, int $ttl = 0): bool
    {
        return static::$redisInstance->setex($uri, $ttl, 1);
    }
    
    /**
     * Increment the uri's counter by the given value.
     *
     * @param     $uri
     * @param int $value
     *
     * @return bool
     */
    public function increment($uri, $value = 1): bool
    {
        return static::$redisInstance->incrBy($uri, $value);
    }
    
    /**
     * Get the current uri's counter value.
     *
     * @param string $uri
     *
     * @return int
     */
    public function get(string $uri): int
    {
        return static::$redisInstance->get($uri);
    }
    
    /**
     * Whether the uri is still in the container.
     *
     * @param string $uri
     *
     * @return bool
     */
    public function exists(string $uri): bool
    {
        return static::$redisInstance->exists($uri);
    }
    
    /**
     * Get all keys.
     *
     * @return mixed
     */
    public function all()
    {
        return static::$redisInstance->keys("*");
    }
}
