<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 下午4:33
 */
namespace hy\handler;

class DeleteHandler {

    public static function run($pdoInstance, $propertyAnnotation, $args) {
        $pattern = "/{(.*?)}/";
        $newArr = [];
        $newSql = $propertyAnnotation->sql;
        if (preg_match_all($pattern, $newSql, $result)) {
            if (!empty ($result[1])) {
                foreach ($result[1] as $key => $val) {
                    if (isset($args[0][$val])) {
                        $newArr[$val] = $args[0][$val];
                        $newSql = preg_replace("/{" . $val . "?}/", ":$val", $newSql);
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
                return true;
            }
            else
            {
                throw new \Exception("删除失败!");
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
                throw new \Exception("删除失败!");
            }
        }
    }
}