<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/14
 * Time: 11:12
 */

namespace Kernel\Http\RateLimiters\Storage;

interface StorageInterface
{
    /**
     * Save the current request uri into the container.
     *
     * @param     $uri
     *
     * @param int $ttl
     *
     * @return bool
     */
    public function store($uri,int $ttl=0): bool;
    
    /**
     * Increment the uri's counter by the given value.
     *
     * @param     $uri
     * @param int $value
     *
     * @return bool
     */
    public function increment($uri, $value = 1): bool;
    
    /**
     * Get the current uri's counter value.
     *
     * @param string $uri
     *
     * @return int
     */
    public function get(string $uri): int;
    
    /**
     * Whether the uri is still in the container.
     * @param string $uri
     *
     * @return bool
     */
    public function exists(string $uri):bool;
    
    /**
     * Get all keys.
     * @return mixed
     */
    public function all();
}