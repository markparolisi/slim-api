<?php
/**
 * ToroHook
 * Taken from https://github.com/anandkunal/ToroPHP
 * @package     erdiko/core
 */
namespace erdiko\core;


class ToroHook
{
    private static $instance;

    private $hooks = array();

    private function __construct()
    {
    }
    private function __clone()
    {
    }

    public static function add($hook_name, $fn)
    {
        $instance = static::get_instance();
        $instance->hooks[$hook_name][] = $fn;
    }

    public static function fire($hook_name, $params = null)
    {
        $instance = static::get_instance();
        if (isset($instance->hooks[$hook_name])) {
            foreach ($instance->hooks[$hook_name] as $fn) {
                call_user_func_array($fn, array(&$params));
            }
        }
    }

    public static function get_instance()
    {
        if (empty(static::$instance)) {
            static::$instance = new ToroHook();
        }
        return static::$instance;
    }
}
