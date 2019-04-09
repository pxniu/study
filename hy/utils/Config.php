<?php
/**
 * @author ZhaoHaoyu
 * @action \Config::get("db.database", "DB_HOST");
 * @action \Config::get("database", "DB-USER");
 */
namespace hy\utils;

class Config implements \ArrayAccess
{
    protected $_path;
    protected $_configs = array();
    protected static $_instance = array();

    public function __construct($_path)
    {
        $this->_path = $_path;
    }

    public static function get($path, $key)
    {
        static::$_instance = new self($path);
        return static::$_instance->offsetGet($key);
    }

    public function offsetGet($key)
    {
        if (! defined("CONF_BASE_PATH"))
        {
            throw new \Exception("please defined CONF_BASE_PATH");
        }
        $path = str_replace(".", "/", $this->_path);

        $this->_configs[$path] = require CONF_BASE_PATH.$path.".php";
        return $this->_configs[$path][$key];
    }

    public function offsetSet($key, $value)
    {
        throw new \Exception("cannot write config file.");
    }

    public function offsetExists($key)
    {
        return isset($this->configs[$key]);
    }

    public function offsetUnset($key)
    {
        unset($this->configs[$key]);
    }
}