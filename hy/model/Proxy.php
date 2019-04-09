<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/4
 * Time: 下午2:16
 * 动态代理 前置处理sql
 */
namespace Hy\Model;

use Doctrine\Common\Annotations\AnnotationReader;

class Proxy {

    private $clsName;
    private $clsInstance;
    private $datas;
    private $pdoInstance;

    public function __construct($class, $pdoInstance)
    {
        $this->pdoInstance = $pdoInstance;
        $cls = new \ReflectionClass($class);
        $this->clsName = $class;
        $this->clsInstance = $cls->newInstance();
    }

    public function __call($name, $args) {
        //执行前置方法
        //echo "前置方法<br />";
        //获取方法注解
        $annotationReader = new AnnotationReader();
        //print_r($args[0]);
        $method = new \ReflectionMethod($this->clsInstance, $name);
        //$propertyAnnotations = $annotationReader->getMethodAnnotation($method, "Hy\\Routing\\Select");
        $propertyAnnotations = $annotationReader->getMethodAnnotations($method);
        if (!empty ($propertyAnnotations)) {
            foreach ($propertyAnnotations as &$propertyAnnotation) {
                $class = is_object($propertyAnnotation) ? get_class($propertyAnnotation) : $propertyAnnotation;
                $resultCls = basename(str_replace('\\', '/', $class));
                switch ($resultCls) {
                    case "Select":
                        $pattern = "/{(.*?)}/";
                        $newArr = [];
                        $newSql = $propertyAnnotation->sql;
                        if (preg_match_all($pattern, $newSql, $result)) {
                            if (!empty ($result[1])) {
                                foreach ($result[1] as $key => $val) {
                                    if (isset($args[0][$val])) {
                                        $newArr[$val] = $args[0][$val];
                                        $newSql = preg_replace("/{".$val."?}/", ":$val", $newSql);
                                    } else {
                                        die("匹配失败! 请仔细检查入参!");
                                    }
                                }
                            } else {
                                die("注解入参写法有误，请仔细检查!");
                            }

                            $stmt = $this->pdoInstance->_pdo->prepare($newSql);
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
                            //$this->_stmt->fetch(constant("PDO::FETCH_ASSOC"));
                            return $stmt->fetchAll(constant("PDO::FETCH_ASSOC"));
                        } else {
                            //没有匹配到 执行sql
                            $stmt = $this->pdoInstance->_pdo->prepare($propertyAnnotation->sql);
                            $stmt->execute();
                            return $stmt->fetchAll(constant("PDO::FETCH_ASSOC"));
                        }
                        break;
                    case "SelectOne":
                        $pattern = "/{(.*?)}/";
                        $newArr = [];
                        $newSql = $propertyAnnotation->sql;
                        if (preg_match_all($pattern, $newSql, $result)) {
                            if (!empty ($result[1])) {
                                foreach ($result[1] as $key => $val) {
                                    if (isset($args[0][$val])) {
                                        $newArr[$val] = $args[0][$val];
                                        $newSql = preg_replace("/{".$val."?}/", ":$val", $newSql);
                                    } else {
                                        die("匹配失败! 请仔细检查入参!");
                                    }
                                }
                            } else {
                                die("注解入参写法有误，请仔细检查!");
                            }

                            $stmt = $this->pdoInstance->_pdo->prepare($newSql);
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
                            //$this->_stmt->fetch(constant("PDO::FETCH_ASSOC"));
                            return $stmt->fetch(constant("PDO::FETCH_ASSOC"));
                        } else {
                            //没有匹配到 执行sql
                            $stmt = $this->pdoInstance->_pdo->prepare($propertyAnnotation->sql);
                            $stmt->execute();
                            return $stmt->fetch(constant("PDO::FETCH_ASSOC"));
                        }
                        break;
                    case "Update":
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

                            $stmt = $this->pdoInstance->_pdo->prepare($newSql);
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
                                throw new \Exception("更新失败!");
                            }
                        }
                        break;
                    case "Insert":
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

                            $stmt = $this->pdoInstance->_pdo->prepare($newSql);
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
                                throw new \Exception("插入失败!");
                            }
                        }
                        break;
                    case "Delete":
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

                            $stmt = $this->pdoInstance->_pdo->prepare($newSql);
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
                        }
                        break;
                }
            }
        }
        $method->invoke($this->clsInstance);
    }

    public function setDatas($key, $val) {
        $this->datas[$key] = $val;
    }

    public function parseSql($sql) {
        $newSql = "";
        return $newSql;
    }
}