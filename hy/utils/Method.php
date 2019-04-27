<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午11:24
 */
namespace hy\utils;

class Method {

    public static $method;
    public static $data;
    public static $server;


    public static function check() {
        p($_SERVER);
    }
}