<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午9:30
 */
namespace hy\utils;

class Ercode {

    public static function show($len = 4) {
        Image::buildImageVerify($len, 1, "png", 100, 40);
    }
}