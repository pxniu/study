<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/30
 * Time: 下午3:50
 */
namespace hy\debug;

use hy\utils\HRedis;

class Debug {

    static public function run()
    {
        ini_set("display_errors", 1);
        $handle = popen("tail -f /Users/haoyu/phpcomposer/study/public/php_error.log 2>&1", 'r');
        while(!feof($handle)) {
            $buffer = fgets($handle);
            header("Content-type:text/html");
            echo "$buffer\n";
            flush();
        }
        pclose($handle);
    }
}