<?php 
namespace Hy\Routing;
class Router 
{
    public static function run()
    {
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
    	$class = "\\app\\controller\\".$route['manage']."\\".$route['controller'];
    	if(is_dir('../app/controller/'.$route['manage']))
    	{
    		define("GROUP_NAME", $route['manage']);
    		define("MODULE_NAME", $route['controller']);
    		define("ACTION_NAME", $route['method']);
            define("__PAGE__",SCRIPT."/".$route['manage']."/".$route['controller']."/".$route['method']."/".$paramStr);
    		$obj = new $class;
    		$obj->manage = $route['manage'];
    		$obj->controller = $route['controller'];
    		$obj->method = $route['method'];
    		$obj->$route['method']($params);
    	}else
    	{
    		throw new \Exception("分组不存在");
    	}
    }
}

