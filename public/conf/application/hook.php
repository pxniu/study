<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/28
 * Time: 下午1:24
 */
return [
    "beforeAction" => [
        "\\hyweb\\controller\\Common\\CheckLogin",
        "\\hyweb\\controller\\Common\\CheckAuth"
    ]
];