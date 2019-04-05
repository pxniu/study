<?php 
namespace Hy\Routing;


use Doctrine\Common\Annotations\AnnotationReader;
use Hy\Model\Proxy;


class Router 
{
    public static function run()
    {
        $vendorDir = dirname(dirname(__FILE__));
        $baseDir = dirname($vendorDir);
    	#$app = str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['REQUEST_URI']);
		$app = $_SERVER['PATH_INFO'];
    	$app = trim($app, "/");
    	$params = array();
    	$route = array(
    			"manage" => "Index",
    			"controller" => "Index",
    			"method" => "index",
    			"param" => array()
    	);
    	
    	$urlArr = explode("/", $app);
    	$count = count($urlArr);
    	$paramStr = "";
    	if($count == 1 && $urlArr[0] != "")
    	{
    		$route['manage'] = $urlArr[0];
    	}elseif($count > 1 && $count < 3)
    	{
    		$route['manage'] = $urlArr[0];
    		$route['controller'] = $urlArr[1];
    	}elseif($count > 2)
    	{
    		$route['manage'] = $urlArr[0];
    		$route['controller'] = $urlArr[1];
    		$route['method'] = $urlArr[2];
    		
    		if($count > 3 && ($count + 1) % 2 != 0)
    		{
    			throw new \Exception("参数不完整");
    		}else 
    		{
    			for($i = 3; $i < $count; $i += 2)
    			{
    				$params[$urlArr[$i]] = $urlArr[$i + 1];
    				$_GET[$urlArr[$i]] = $urlArr[$i + 1];
                    $paramStr .= $urlArr[$i]."/".$urlArr[$i + 1]."/";
    			}
    		}
            $paramStr = rtrim($paramStr, "/");
    	}
    	$class = "\\Hyweb\\".$route['manage']."\\".$route['controller'];

    	if(is_dir($baseDir.'/hyweb/'.$route['manage']))
    	{
    		define("GROUP_NAME", $route['manage']);
    		define("MODULE_NAME", $route['controller']);
    		define("ACTION_NAME", $route['method']);
            //define("__PAGE__",SCRIPT."/".$route['manage']."/".$route['controller']."/".$route['method']."/".$paramStr);


            $annotationReader = new AnnotationReader();
            $cls = new \ReflectionClass($class);
            $clsIns = $cls->newInstance();
            foreach ($cls->getProperties() as &$property)
            {
                $propertyAnnotations = $annotationReader->getPropertyAnnotations($property);

                foreach ($propertyAnnotations as $key => &$propertyAnnotation)
                {
                    $xxx = new \ReflectionClass("Hy\\Model\\Proxy");
                    $vvv = $xxx->newInstance($propertyAnnotation->class, $propertyAnnotation->tableName);
                    //$kkk = new \ReflectionMethod($vvv,"__call");
                    $property->setAccessible(true);
                    $property->setValue($clsIns, $vvv);

//                    die;
//                    $class = is_object($propertyAnnotation) ? get_class($propertyAnnotation) : $propertyAnnotation;
//                    $resultCls = basename(str_replace('\\', '/', $class));
//                    $refCls = null;
//                    try {
//                        $class = new \ReflectionClass($propertyAnnotation->class);
//                        $refCls = $class->newInstance($propertyAnnotation->tableName);
//                        $property->setAccessible(true);
//                        $property->setValue($clsIns, $refCls);
//                    } catch (\Exception $e) {
//                        throw  new \Exception("注解\"".$resultCls."\"的class\"".$propertyAnnotation->class."\"不存在!");
//                    }
                }
            }

            $farMethod = new \ReflectionMethod($clsIns, "index");
            $farMethod->invoke($clsIns);
    	}else
    	{
    		throw new \Exception("分组不存在");
    	}
    }
}
