<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午9:21
 */
function p($arr) {
    echo "<pre>";
    print_r($arr);
    echo "</pre>";
}

function I($name) {
    switch($_SERVER['REQUEST_METHOD']) {
        case 'POST':
            $input  =  $_POST;
            break;
        case 'PUT':
            parse_str(file_get_contents('php://input'), $input);
            break;
        default:
            $input  =  $_GET;
    }
    if (isset($input[$name])) {
        $xxx = $input[$name];
        $xxx = preg_replace('/ /','',$xxx);
        $farr = array(
            "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
            "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
            "/select\b|insert\b|update\b|delete\b|drop\b|or\b|and\b|truncate\b|eval|system|;|\"|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
        );

        foreach ($farr as $val) {
            if (preg_match($val, $xxx, $result)) {
                //$error['code'] = 0;
                //$error['msg'] = "非法请求!";
                //echo json_encode($error, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);die;
                return null;
            }
        }
        return $xxx;
    } else {
        return null;
    }
}