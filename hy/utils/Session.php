<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/28
 * Time: 下午1:48
 */
namespace hy\utils;

class Session
{
    /**
     * session设置
     * @access public
     * @param  string        $name session名称
     * @param  mixed         $value session值
     * @param  string|null   $prefix 作用域（前缀）
     * @return void
     */
    static public function set($name, $value)
    {
        session_start();
        $_SESSION[$name] = $value;
        session_write_close();
    }

    /**
     * session获取
     * @access public
     * @param  string        $name session名称
     * @param  string|null   $prefix 作用域（前缀）
     * @return mixed
     */
    static public function get($name = '')
    {
        session_start();
        $val = null;
        if (isset($_SESSION[$name])) {
            $val = $_SESSION[$name];
        }
        session_write_close();
        return $val;
    }


    /**
     * 删除session数据
     * @access public
     * @param  string|array  $name session名称
     * @param  string|null   $prefix 作用域（前缀）
     * @return void
     */
    static public function delete($name)
    {
        session_start();
        unset($_SESSION[$name]);
        session_write_close();
    }
}
