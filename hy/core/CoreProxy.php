<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 上午8:39
 */
namespace Hy\core;
use Doctrine\Common\Annotations\AnnotationReader;

class CoreProxy {

    private $cls;
    private $clsInstance;
    private $clsName;
    private $pdoInstance;

    public function __construct($class)
    {
        $this->cls = new \ReflectionClass($class);
        $this->clsInstance = $this->cls->newInstance();

        $this->pdoInstance = PdoInstance::getInstance();
        //获取属性注解
        $annotationReader = new AnnotationReader();
        foreach ($this->cls->getProperties() as &$property) {
            $propertyAnnotations = $annotationReader->getPropertyAnnotations($property);
            foreach ($propertyAnnotations as $key => &$propertyAnnotation) {
                $xxx = new \ReflectionClass("Hy\\model\\Proxy");
                $vvv = $xxx->newInstance($propertyAnnotation->class, $this->pdoInstance);
                $property->setAccessible(true);
                $property->setValue($this->clsInstance, $vvv);
            }
        }

    }

    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        $annotationReader = new AnnotationReader();
        $method = new \ReflectionMethod($this->clsInstance, $name);
        //$propertyAnnotations = $annotationReader->getMethodAnnotation($method, "Hy\\Routing\\Select");
        $propertyAnnotations = $annotationReader->getMethodAnnotations($method);
        if (!empty ($propertyAnnotations)) {
            foreach ($propertyAnnotations as &$propertyAnnotation) {
                $class = is_object($propertyAnnotation) ? get_class($propertyAnnotation) : $propertyAnnotation;
                $resultCls = basename(str_replace('\\', '/', $class));
                switch ($resultCls) {
                    case "Transactional": //事物方法

                        $method = new \ReflectionMethod($this->clsInstance, $name);
                        //echo "前置方法";
                        //开启事物
                        $result = null;
                        try {
                            $this->pdoInstance->getPdo()->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
                            $this->pdoInstance->getPdo()->beginTransaction();
                            if (isset($arguments[0])) {
                                $result = $method->invoke($this->clsInstance, $arguments[0]);
                            } else {
                                $result = $method->invoke($this->clsInstance, $arguments);
                            }
                            $this->pdoInstance->getPdo()->commit();
                        } catch (\Exception $exception) {
                            $this->pdoInstance->getPdo()->rollBack();
                        }
                        $this->pdoInstance->setPdo(null);
                        return $result;
                        //echo "后置方法";
                        break;
                }
            }
        } else {
            $method = new \ReflectionMethod($this->clsInstance, $name);
            //echo "前置方法";
            if (isset($arguments[0])) {
                return $method->invoke($this->clsInstance, $arguments[0]);
            } else {
                return $method->invoke($this->clsInstance, $arguments);
            }
            //echo "后置方法";
        }


    }
}