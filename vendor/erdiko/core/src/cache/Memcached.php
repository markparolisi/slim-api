<?php
/**
 * Cache using Memcached
 *
 * @package     erdiko/core
 * @copyright   2012-2017 Arroyo Labs, Inc. http://www.arroyolabs.com
 * @author      Varun Brahme
 * @author      John Arroyo <john@arroyolabs.com>
 */
namespace erdiko\core\cache;

use erdiko\core\cache\CacheInterface;


class Memcached implements CacheInterface
{
    /**
     * Memcached Object
     */
    protected $memcacheObj;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        // Connection creation
        $this->memcacheObj = new \Memcached;

        $config = \erdiko\core\Helper::getConfig("local/cache");
        $host=$config["memcached"]["host"];
        $port=$config["memcached"]["port"];
        $cacheAvailable = $this->memcacheObj->addServer($host, $port);

    }

    /**
     * Destructor
     */
    public function __destruct()
    {
        $this->memcacheObj->quit();
        unset($this->memcacheObj);
    }

    /**
     *  Get Cache Object
     *
     *  @return Memcache $memcacheObj
     *  @note   Please do not modify data if you use the put function in this class
     */
    public function getObject()
    {
        return $this->memcacheObj;
    }

    /**
     *  MD5 encode
     *
     *  @parm mixed $key
     *  @return string $key
     */
    public function getKeyCode($key)
    {
        return md5($key);
    }


    /**
     *  Put data into cache
     *
     *  @parm mixed $key
     *  @parm mixed $data
     *  @note If you put a object into cache,
     *        the json_encode function will ignore any private property.
     */
    public function put($key, $data)
    {

        $key = $this->getKeyCode($key);
        $data = json_encode($data);
        $this->memcacheObj->set($key, $data);
    }
    
    /**
     *  Get value from cache
     *
     *  @parm mixed $key
     *  @return string $value
     *  @note Any cache array will get return as object
     *  @note If you need an array, use (array) $object
     *
     */
    public function get($key)
    {
        $key = $this->getKeyCode($key);
        $value = $this->memcacheObj->get($key);
        return json_decode($value);
    }

    /**
     *  Check if the key exists in cache
     *
     *  @parm mixed $key
     *  @return true if the key exist in cache
     *  @return false if the key does not exist in cache
     *
     */
    public function has($key)
    {
        $key = $this->getKeyCode($key);

        $value = $this->memcacheObj->get($key);
        
        if (!$value) {
            return false;
        } else {
            return true;
        }
    }
    
    /**
     *  Remove a key from cache
     *
     *  @parm mixed $key
     *
     */
    public function delete($key)
    {
        $filename = $this->getKeyCode($key);
        $this->memcacheObj->delete($filename);
    }

    /**
     *  Flush all the cache
     */
    public function clear()
    {
        $this->memcacheObj->flush();
    }
}
