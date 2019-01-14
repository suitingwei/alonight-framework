<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/14
 * Time: 10:08
 */

namespace Kernel\Http\RateLimiters;

use Kernel\Http\RateLimiters\Storage\RedisStorage;
use Kernel\Http\RateLimiters\Storage\StorageInterface;

class SimpleCounterWithWindow implements RateLimiter
{
    /**
     * The storage for the request's info.
     * If this property is null, then we'll use the memory to store the message.
     * Otherwise the storage component will be used.
     *
     * @var StorageInterface
     */
    private $storage = null;
    
    /**
     * Window size, in seconds.
     * @var float
     */
    private $interval = 0.1;
    
    /**
     * The rate limit rules.
     *
     * @var array  [
     *             'uri' => [ 'timeRange => 10, //seconds 'maxTimes'=> 500, //times ],
     *             'uri2' => [ 'timeRange => 10, //seconds 'maxTimes'=> 500, //times ],
     *             'uri3' => [ 'timeRange => 10, //seconds 'maxTimes'=> 500, //times ],
     * ];
     */
    private $rules = [];
    
    public function __construct(StorageInterface $storage = null)
    {
        if (is_null($storage)) {
            $storage = new RedisStorage();
        }
        $this->storage = $storage;
    }
    
    /**
     * @param string $uri The url to be limited.
     *
     * @return bool True means that the request can be executed, and false means that the request has hit the rate limit.
     * @throws \Exception
     */
    public function canProcess(string $uri): bool
    {
        $uriRule   = $this->getRuleConfig($uri);
        $maxTimes  = $uriRule['maxTimes'];
        $timeRange = $uriRule['timeRange'];
        
        //If the request has reached the rate limit, then return false.
        if ($this->storage->get($uri) >= $maxTimes) {
            throw new \Exception("The {$uri} has reached the rate limit!");
        }
        //If the uri has been save it, then increment the counter.
        if ($this->storage->exists($uri)) {
            echo sprintf("The {$uri} exists, increment it.\n" );
            $this->storage->increment($uri);
        } //If the uri has not been saved, then initialized it.
        else {
            echo sprintf("The {$uri} is not exists, create it.\n" );
            $this->storage->store($uri,$timeRange);
        }
        
        return true;
    }
    
    /**
     * @return StorageInterface
     */
    public function getStorage(): StorageInterface
    {
        return $this->storage;
    }
    
    /**
     * @param string $uri
     * @param int    $maxTimes
     * @param int    $timeRange
     *
     * @return bool
     */
    public function addRule(string $uri, int $maxTimes, int $timeRange): bool
    {
        $this->rules[$uri] = [
            'timeRange' => $timeRange,
            'maxTimes'  => $maxTimes
        ];
        
        return true;
    }
    
    /**
     * Get the config for the uri.
     *
     * @param string $uri
     *
     * @return array  ['maxTimes'=> 500, 'timeRange'=> 500]
     * @throws \Exception
     */
    public function getRuleConfig(string $uri): array
    {
        if (isset($this->rules[$uri])) {
            return $this->rules[$uri];
        }
        throw new \Exception("Uri {$uri} rule not found");
    }
}
