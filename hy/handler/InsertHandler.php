<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 下午4:32
 */
namespace hy\handler;

use hy\utils\Logs;

class InsertHandler {

    public static $lastInsId;

    public static function run($pdoInstance, $propertyAnnotation, $args) {
        $pattern = "/{(.*?)}/";
        $newArr = [];
        $newSql = ParseSqlHandler::parseSql($propertyAnnotation->sql, $args);

        if (preg_match_all("/\<foreach\s+collection\=\'(.*?)\'\>(.+?)\<\/foreach\>/ies", $newSql, $r)) {
            $loopStr = "";
            foreach ($r[1] as $key => $val) {
                if (isset($args[0][$val])) {
                    if (is_array($args[0][$val])) {
                        foreach($args[0][$val] as $k => $v) {
                            $args[0]["pattern".$v] = $v;
                            $loopStr .= preg_replace("/\#(.*?)\#/", "{pattern".$v."}", $r[2][0]).",";
                        }
                    } else {
                        Logs::info("插入sql语句中的循环参数不是数组!");
                        throw new \Exception("请传递数组!");
                    }
                } else {
                    Logs::info("插入sql语句中的循环参数不存在!");
                    throw new \Exception("循环参数不存在!");
                }
            }
            $newSql = preg_replace("/\<foreach\s+collection\=\'(.*?)\'\>(.+?)\<\/foreach\>/is", rtrim($loopStr, ","), $newSql);
        }
        if (preg_match_all($pattern, $newSql, $result)) {
            if (!empty ($result[1])) {
                foreach ($result[1] as $key => $val) {
                    if (isset($args[0][$val])) {
                        $newArr[$val] = $args[0][$val];
                        $newSql = preg_replace("/{" . $val . "?}/", ":$val", $newSql);
                    } else {
                        throw new \Exception("匹配失败! 请仔细检查入参!");
                    }
                }
            } else {
                throw new \Exception("注解入参写法有误，请仔细检查!");
            }
            $stmt = $pdoInstance->_pdo->prepare($newSql);
            foreach($newArr as $k => $v)
            {
                if (gettype($v) == "integer") {
                    $stmt->bindValue(":$k", $v, \PDO::PARAM_INT);
                } elseif (gettype($v) == "double") {
                    $stmt->bindValue(":$k", $v, \PDO::PARAM_INT);
                } else {
                    $stmt->bindValue(":$k", $v, \PDO::PARAM_STR);
                }
            }
            $stmt->execute();
            $affect_row = $stmt->rowCount();
            if($affect_row)
            {
                return $pdoInstance->_pdo->lastInsertId();
            }
            else
            {
                throw new \Exception("插入失败!");
            }
        } else {
            //没有匹配到 执行sql
            $stmt = $pdoInstance->_pdo->prepare($propertyAnnotation->sql);
            $stmt->execute();
            $affect_row = $stmt->rowCount();
            if($affect_row)
            {
                return true;
            }
            else
            {
                throw new \Exception("插入失败!");
            }
        }
    }
}