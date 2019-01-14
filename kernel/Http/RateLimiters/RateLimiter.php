<?php
/**
 * Created by PhpStorm.
 * User: sui
 * Date: 2019/1/14
 * Time: 10:09
 */

namespace kernel\Http\RateLimiters;

interface RateLimiter
{
    /**
     * @param string $url       The url to be limited.
     * @param int    $maxTimes  The max times can be requested in the time range.
     * @param int    $timeRange The time range.
     *
     * @return bool
     */
    public function canProcess(string $url): bool;
    
    /**
     * Add one rule into the rate limiter.
     *
     * @param string $uri
     * @param int    $maxTimes
     * @param int    $timeRange
     *
     * @return bool
     */
    public function addRule(string $uri, int $maxTimes, int $timeRange): bool;
    
    /**
     * Get the config for the uri.
     *
     * @param string $uri
     *
     * @return array  ['maxTimes'=> 500, 'timeRange'=> 500]
     */
    public function getRuleConfig(string $uri): array;
}