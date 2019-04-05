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
    private $tableName;
    private $datas;

    public function __construct($class, $tableName)
    {
        $cls = new \ReflectionClass($class);
        $this->clsName = $class;
        $this->clsInstance = $cls->newInstance();
        $this->tableName = $tableName;
    }

    public function __call($name, $args) {
        //执行前置方法
        echo "前置方法<br />";
        //获取方法注解
        $annotationReader = new AnnotationReader();
        print_r($args[0]);
        $method = new \ReflectionMethod($this->clsInstance, $name);
        //$propertyAnnotations = $annotationReader->getMethodAnnotation($method, "Hy\\Routing\\Select");
        $propertyAnnotations = $annotationReader->getMethodAnnotations($method);
        if (!empty ($propertyAnnotations)) {
            foreach ($propertyAnnotations as &$propertyAnnotation) {
                $class = is_object($propertyAnnotation) ? get_class($propertyAnnotation) : $propertyAnnotation;
                $resultCls = basename(str_replace('\\', '/', $class));
                switch ($resultCls) {
                    case "Select":
                        echo "查询".$propertyAnnotation->sql;
                        $arr['name'] = "zhangsan";
                        $arr['email'] = "aaa";
                        unset($arr['name']);
                        print_r($arr);
                        echo "<pre>";
                        print_r($_SERVER);
                        break;
                }
            }
        }
        $method->invoke($this->clsInstance);
    }

    public function setDatas($key, $val) {
        $this->datas[$key] = $val;
    }
}