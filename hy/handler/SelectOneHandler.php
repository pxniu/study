<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 下午3:19
 */
namespace hy\handler;

class SelectOneHandler {

    public static function run($pdoInstance, $propertyAnnotation, $args) {
        $pattern = "/{(.*?)}/";
        $newArr = [];
        $newSql = ParseSqlHandler::parseSql($propertyAnnotation->sql, $args);
        if (preg_match_all($pattern, $newSql, $result)) {
            if (!empty ($result[1])) {
                foreach ($result[1] as $key => $val) {
                    if (isset($args[0][$val])) {
                        $newArr[$val]['val'] = $args[0][$val];
                        $newSql = preg_replace("/{".$val."?}/", ":$val", $newSql);
                        if (preg_match("/%:$val%/", $newSql, $r)) {
                            $newArr[$val]['like'] = "all";
                            $newSql = preg_replace("/%:$val%/", ":$val", $newSql);
                        } elseif (preg_match("/%:$val/", $newSql, $r)) {
                            $newArr[$val]['like'] = "left";
                            $newSql = preg_replace("/%:$val/", ":$val", $newSql);
                        } elseif (preg_match("/$val%/", $newSql, $r)) {
                            $newArr[$val]['like'] = "right";
                            $newSql = preg_replace("/$val%/", $val, $newSql);
                        } else {
                            $newArr[$val]['like'] = "none";
                        }
                    } else {
                        die("匹配失败! 请仔细检查入参!");
                    }
                }
            } else {
                die("注解入参写法有误，请仔细检查!");
            }

            $stmt = $pdoInstance->_pdo->prepare($newSql);
            foreach($newArr as $k => $v)
            {
                if ($v['like'] == "none") {
                    if (gettype($v['val']) == "integer") {
                        $stmt->bindValue(":$k", $v['val'], \PDO::PARAM_INT);
                    } elseif (gettype($v['val']) == "double") {
                        $stmt->bindValue(":$k", $v['val'], \PDO::PARAM_INT);
                    } else {
                        $stmt->bindValue(":$k", $v['val'], \PDO::PARAM_STR);
                    }
                } elseif ($v['like'] == "all") {
                    if (gettype($v['val']) == "integer") {
                        $stmt->bindValue(":$k", "%".$v['val']."%", \PDO::PARAM_INT);
                    } elseif (gettype($v['val']) == "double") {
                        $stmt->bindValue(":$k", "%".$v['val']."%", \PDO::PARAM_INT);
                    } else {
                        $stmt->bindValue(":$k", "%".$v['val']."%", \PDO::PARAM_STR);
                    }
                } elseif ($v['like'] == "left") {
                    if (gettype($v['val']) == "integer") {
                        $stmt->bindValue(":$k", "%".$v['val'], \PDO::PARAM_INT);
                    } elseif (gettype($v['val']) == "double") {
                        $stmt->bindValue(":$k", "%".$v['val'], \PDO::PARAM_INT);
                    } else {
                        $stmt->bindValue(":$k", "%".$v['val'], \PDO::PARAM_STR);
                    }
                } elseif ($v['like'] == "right") {
                    if (gettype($v['val']) == "integer") {
                        $stmt->bindValue(":$k", $v['val']."%", \PDO::PARAM_INT);
                    } elseif (gettype($v['val']) == "double") {
                        $stmt->bindValue(":$k", $v['val']."%", \PDO::PARAM_INT);
                    } else {
                        $stmt->bindValue(":$k", $v['val']."%", \PDO::PARAM_STR);
                    }
                }
            }
            $stmt->execute();
            //$this->_stmt->fetch(constant("PDO::FETCH_ASSOC"));
            return $stmt->fetch(constant("PDO::FETCH_ASSOC"));
        } else {
            //没有匹配到 执行sql
            $stmt = $pdoInstance->_pdo->prepare($propertyAnnotation->sql);
            $stmt->execute();
            return $stmt->fetch(constant("PDO::FETCH_ASSOC"));
        }
    }
}