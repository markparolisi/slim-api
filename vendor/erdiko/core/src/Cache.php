<?php
/**
 * Cache
 * Dependency injected cache API
 *
 * @package     erdiko/core
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\core;


class Cache
{
    /** Cache singleton instance */
    private static $instance = array();

    /**
     * Get the cache instance
     *
     * @param string $cacheConfig
     * @return object
     */
    public static function getCacheObject($cacheConfig = 'default')
    {
            //Check if the caller requests an new object
        if (empty(static::$instance[$cacheConfig])) {
            $config = Helper::getConfig('application', $cacheConfig);

            //Check if the object already be created
            if (isset($config["cache"][$cacheConfig])) {
                static::$instance[$cacheConfig] = new $config["cache"][$cacheConfig]['class'];
            } else {
                throw new \Exception("There is no cache config defined ({$cacheConfig})");
            }
        }

        return static::$instance[$cacheConfig];

    }

    /**
     * Get the value stored at the given key
     *
     * @param string $key
     * @param string $cacheConfig
     */
    public static function get($key, $cacheConfig = 'default')
    {
        return static::getCacheObject($cacheConfig)->get($key);
    }

    /**
     * Put the supplied value into the given key
     *
     * @param string $key
     * @param mixed $value
     * @param string $cacheConfig
     */
    public static function put($key, $value, $cacheConfig = 'default')
    {
        return static::getCacheObject($cacheConfig)->put($key, $value);
    }
    
    /**
     * Check if the key exist
     *
     * @param string $key
     * @param string $cacheConfig
     * @return bool
     */
    public static function has($key, $cacheConfig = 'default')
    {
        return static::getCacheObject($cacheConfig)->has($key);
    }

    /**
     * Retrieve the cache value and then delete it before returning that value
     *
     * @param string $key
     * @param string $cacheConfig
     * @return mixed
     */
    public static function pull($key, $cacheConfig = 'default')
    {
        $value = static::get($key);
        static::delete($key);

        return $value;
    }

    /**
     * Remove an item from the cache
     *
     * @param string $key
     * @param string $cacheConfig
     * @return bool
     */
    public static function delete($key, $cacheConfig = 'default')
    {
        return static::getCacheObject($cacheConfig)->delete($key);
    }

    /**
     * Delete all cache keys (Purge)
     *
     * @param string $cacheConfig
     * @return bool
     */
    public static function clear($cacheConfig = 'default')
    {
        return static::getCacheObject($cacheConfig)->clear();
    }
}
