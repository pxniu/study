<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午1:59
 */
namespace hy\utils;
class JsonData {

    public $code;
    public $msg;
    public $data;
    public $count;

    public static function success($data = "", $code = 1) {
        header('Content-Type:application/json; charset=utf-8');
        $jsonData = new JsonData();
        $jsonData->code = $code;
        $jsonData->msg = "success";
        $jsonData->data = $data;
        echo json_encode($jsonData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);die;
    }

    public static function fail($msg = "") {
        header('Content-Type:application/json; charset=utf-8');
        $jsonData = new JsonData();
        $jsonData->code = 0;
        $jsonData->msg = $msg;
        echo json_encode($jsonData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);die;
    }

    public static function jsonList($data = "", $count = 0) {
        header('Content-Type:application/json; charset=utf-8');
        $jsonData = new JsonData();
        $jsonData->code = 0;
        $jsonData->count = $count;
        $jsonData->msg = "success";
        $jsonData->data = $data;
        echo json_encode($jsonData, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);die;
    }
}
