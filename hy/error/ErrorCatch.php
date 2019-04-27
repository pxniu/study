<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/26
 * Time: 下午9:27
 */
namespace hy\error;
class ErrorCatch {
    private function __construct(){

    }
    static public $instance;
    static public function getinstance(){
        if(!self::$instance) self::$instance = new self();
        return self::$instance;
    }

    static public function run() {
        ini_set('date.timezone','Asia/Shanghai');
        register_shutdown_function(array('hy\error\ErrorCatch','systemError'));
        set_error_handler(array('hy\error\ErrorCatch', 'systemNotice'));
        set_exception_handler(array('hy\error\ErrorCatch', "systemException"));
    }

    static public function systemError() {
        if ($error = error_get_last()) {
            $time = date('Y-m-d H:i:s');
            //拼接要记录成日志的信息
            $str = "\n ".$time.' systemError: Type:' . self::get_type($error['type']) . ' Msg: ' . $error['message'] . ' in ' . $error['file'] . ' on line ' . $error['line'];
            //记录日志    error_log是PHP自带函数，记录到指定位置，还可以发送邮件以及其他操作
            error_log($str,3,"php_error.log");
            //直接输出接口的返回信息， 给前端一个错误码code, msg返回时间用于方便查找日志
            $echoStr = $time.' systemError: Type:' . self::get_type($error['type']) . ' Msg: ' . $error['message'] . ' in ' . $error['file'] . ' on line ' . $error['line'];
            $type = self::get_type($error['type']);
            ErrorDebug::html($type, $echoStr);die;
        }
    }

    static public function systemNotice($type, $message, $file, $line) {
        $time = date('Y-m-d H:i:s');
        //拼接要记录成日志的信息
        $str = "\n ".$time.' systemNotice: ' . self::get_type($type) . ':' . $message . ' in ' . $file . ' on ' . $line . ' line .';
        //记录日志    error_log是PHP自带函数，记录到指定位置，详情见官网
        error_log($str,3,"php_error.log");
        //对于notice和warning 级别的错误，只进行记录而不会终止程序
        $echoStr = $time.' systemNotice: ' . self::get_type($type) . ':' . $message . ' in ' . $file . ' on ' . $line . ' line .';
        $type = self::get_type($type);
        ErrorDebug::html($type, $echoStr);
    }

    static function systemException($exception) {
        $time = date('Y-m-d H:i:s');
        //拼接要记录成日志的信息
        $str = "\n ".$time." systemException: Exception: ". $exception->getMessage()." in ".$exception->getFile()." on line ". $exception->getLine();
        //记录日志
        error_log($str,3,"php_error.log");
        //输出信息
        $echoStr = $time." systemException: Exception: ". $exception->getMessage()." in ".$exception->getFile()." on line ". $exception->getLine();
        ErrorDebug::html("Exception", $echoStr);
    }

    //PHP的错误级别
    public static $type =  array(
        '1' => 'E_ERROR ',
        '2' => 'E_WARNING  ',
        '4' => 'E_PARSE  ',
        '8' => 'E_NOTICE  ',
        '16' => 'E_CORE_ERROR  ',
        '32' => 'E_CORE_WARNING  ',
        '64' => 'E_COMPILE_ERROR  ',
        '128' => 'E_COMPILE_WARNING  ',
        '256' => 'E_USER_ERROR  ',
        '512' => 'E_USER_WARNING  ',
        '1024' => 'E_USER_NOTICE  ',
        '2048' => 'E_STRICT  ',
        '4096' => 'E_RECOVERABLE_ERROR  ',
        '8191' => 'E_ALL  ',
    );

    public static function get_type($key)
    {
        if(isset(self::$type[$key]))
        {
            return self::$type[$key];
        }else
        {
            return $key;
        }
    }
}