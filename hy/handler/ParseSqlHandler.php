<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/24
 * Time: 上午9:03
 */
namespace hy\handler;

class ParseSqlHandler {

    public static function parseSql($oldSql, $args) {
        $resSql = $oldSql;
        if (preg_match_all("/\<if\stest\=\'(.*?)\'\>(.*?)\<\/if\>/s", $oldSql, $result)) {
            if (!empty ($result[1])) {
                foreach ($result[1] as $key => $val) {
                    if (strstr($val, "==")) {
                        //等于
                        $res = explode("==", $val);
                        $prev = trim($res[0]);
                        $next = strtolower(trim($res[1]));
                        if (array_key_exists($prev, $args[0])) {
                            if ($next == "null") {
                                if ($args[0][$prev] == null) {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                                } else {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                                }
                            } else {
                                if ($args[0][$prev] == $next) {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                                } else {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                                }
                            }
                        } else {
                            die("等于判断参数入参失败");
                        }
                    } else if (strstr($val, "!=")) {
                        //不等于
                        $res = explode("!=", $val);
                        $prev = trim($res[0]);
                        $next = strtolower(trim($res[1]));
                        if (array_key_exists($prev, $args[0])) {
                            if ($next == "null") {
                                if ($args[0][$prev] != null) {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                                } else {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                                }
                            } else {
                                if ($args[0][$prev] != $next) {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                                } else {
                                    $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                                }
                            }

                        } else {
                            die("不等于判断参数入参失败");
                        }
                    } else if (strstr($val, ">")) {
                        //大于
                        $res = explode(">", $val);
                        $prev = trim($res[0]);
                        $next = strtolower(trim($res[1]));
                        if (array_key_exists($prev, $args[0])) {
                            if ($args[0][$prev] > $next) {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                            } else {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                            }
                        } else {
                            die("大于判断参数入参失败");
                        }
                    } else if (strstr($val, "<")) {
                        //小于
                        $res = explode("<", $val);
                        $prev = trim($res[0]);
                        $next = strtolower(trim($res[1]));
                        if (array_key_exists($prev, $args[0])) {
                            if ($args[0][$prev] < $next) {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                            } else {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                            }
                        } else {
                            die("小于判断参数入参失败");
                        }
                    } else if (strstr($val, ">=")) {
                        //大于等于
                        $res = explode(">=", $val);
                        $prev = trim($res[0]);
                        $next = strtolower(trim($res[1]));
                        if (array_key_exists($prev, $args[0])) {
                            if ($args[0][$prev] >= $next) {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                            } else {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                            }
                        } else {
                            die("大于等于判断参数入参失败");
                        }
                    } else if (strstr($val, "<=")) {
                        //小于等于
                        $res = explode("<=", $val);
                        $prev = trim($res[0]);
                        $next = strtolower(trim($res[1]));
                        if (array_key_exists($prev, $args[0])) {
                            if ($args[0][$prev] <= $next) {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "\\1", $resSql);
                            } else {
                                $resSql = preg_replace("/\<if\stest\=\'$val\'\>(.*?)\<\/if\>/s", "", $resSql);
                            }
                        } else {
                            die("小于等于判断参数入参失败");
                        }
                    }
                }
            }
        }
        return $resSql;
    }
}