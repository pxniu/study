<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/4
 * Time: 下午2:16
 * 动态代理 前置处理sql
 */
namespace hy\proxy;

use Doctrine\Common\Annotations\AnnotationReader;
use hy\exception\TransactionalException;
use hy\handler\DeleteHandler;
use hy\handler\InsertHandler;
use hy\handler\SelectHandler;
use hy\handler\SelectOneHandler;
use hy\handler\UpdateHandler;

class Proxy {

    private $clsName;
    private $clsInstance;
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
                        return SelectHandler::run($this->pdoInstance, $propertyAnnotation, $args);
                        break;
                    case "SelectOne":
                        return SelectOneHandler::run($this->pdoInstance, $propertyAnnotation, $args);
                        break;
                    case "Update":
                        return UpdateHandler::run($this->pdoInstance, $propertyAnnotation, $args);
                        break;
                    case "Insert":
                        return InsertHandler::run($this->pdoInstance, $propertyAnnotation, $args);
                        break;
                    case "Delete":
                        return DeleteHandler::run($this->pdoInstance, $propertyAnnotation, $args);
                        break;
                }
            }
        }
    }
}