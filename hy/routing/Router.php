<?php 
namespace hy\routing;


use Doctrine\Common\Annotations\AnnotationReader;
use hy\utils\Config;


class Router 
{
    public static function run()
    {
        $vendorDir = dirname(dirname(__FILE__));
        $baseDir = dirname($vendorDir);
    	#$app = str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['REQUEST_URI']);

        if (!empty ($_SERVER['PATH_INFO'])) {
            $app = $_SERVER['PATH_INFO'];
        } else {
            $app = preg_replace("/\?(.*)/", "", str_replace($_SERVER['SCRIPT_NAME'], "", $_SERVER['REQUEST_URI']));
        }
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
    	$class = "\\hyweb\\controller\\".$route['manage']."\\".$route['controller'];

    	if(is_dir($baseDir.'/hyweb/controller/'.$route['manage']))
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
                    $xxx = new \ReflectionClass("hy\\proxy\\CoreProxy");
                    $vvv = $xxx->newInstance($propertyAnnotation->class);
                    $property->setAccessible(true);
                    $property->setValue($clsIns, $vvv);
                }
            }
            $farMethod = new \ReflectionMethod($clsIns, $route['method']);

            //前置hook
            $beforeAction = Config::get("application.hook", "beforeAction");
            if (!empty($beforeAction)) {
                foreach ($beforeAction as $key => $val) {
                    $beforeCls = new \ReflectionClass($val);
                    $beforeIns = $beforeCls->newInstance();

                    foreach ($beforeCls->getProperties() as &$pro)
                    {
                        $proAnnotations = $annotationReader->getPropertyAnnotations($pro);

                        foreach ($proAnnotations as $k => &$proAnnotation)
                        {
                            $xxx = new \ReflectionClass("hy\\proxy\\CoreProxy");
                            $vvv = $xxx->newInstance($proAnnotation->class);
                            $pro->setAccessible(true);
                            $pro->setValue($beforeIns, $vvv);
                        }
                    }
                    $beforeMethod = new \ReflectionMethod($beforeIns, "run");
                    $beforeMethod->invoke($beforeIns);
                }
            }

            $farMethod->invoke($clsIns);
    	}else
    	{
    		throw new \Exception("分组不存在");
    	}
    }
}

