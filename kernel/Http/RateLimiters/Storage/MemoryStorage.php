<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/14
 * Time: 11:13
 */

namespace Kernel\Http\RateLimiters\Storage;


class MemoryStorage implements StorageInterface
{
    /**
     * @var array
     */
    private $container = [];
    
    /**
     * Save the current request uri into the container.
     *
     * @param     $uri
     *
     * @param int $ttl
     *
     * @return bool
     */
    public function store($uri,int $ttl=0): bool
    {
        $this->container[$uri] = 1;
        
        return true;
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
        if (isset($this->container[$uri])) {
            $this->container[$uri] += $value;
            
            return true;
        }
        
        return false;
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
        return $this->container[$uri] ?? 0;
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
        return isset($this->container[$uri]);
    }
    
    /**
     * Get all keys.
     *
     * @return mixed
     */
    public function all()
    {
        return $this->container;
    }
}
