<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/25
 * Time: 下午1:17
 */
namespace hy\utils;

class Logs {

    public static function info($msg) {
        file_put_contents("[".date("Y-m-d H:i:s")."] 信息[".$msg."]\r\n", FILE_APPEND);
    }
}