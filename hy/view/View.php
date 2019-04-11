<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/10
 * Time: 下午3:26
 */
namespace hy\view;
class View
{
    public $view;
    public $data;
    public $isJson;

    public function __construct($view, $isJson = false)
    {
        $this->view = $view;
        $this->isJson = $isJson;
    }

    public static function make($viewName = null)
    {
        if (!defined('VIEW_BASE_PATH'))
        {
            throw new \Exception("VIEW_BASE_PATH is undefined!");
        }

        if (!$viewName)
        {
            throw new \Exception("View name can not be empty!");
        } else
        {
            $viewFilePath = self::getFilePath($viewName);
            if (is_file($viewFilePath))
            {
                return new View($viewFilePath);
            } else
            {
                throw new \Exception("View file does not exist!");
            }
        }
    }

    public static function json($arr)
    {
        if (!is_array($arr))
        {
            throw new \Exception("View::json can only recieve Array!");
        } else
        {
            return new View($arr, true);
        }
    }

    public static function process($view = null)
    {
        if (is_string($view))
        {
            echo $view;
            return;
        }
        if (isset($view) && $view->isJson)
        {
            echo json_encode($view->view);
        } else
        {
            if($view instanceof View)
            {
                if($view->data)
                {
                    extract($view->data);
                }
                require $view->view;
            }
        }
    }

    public function with($key, $value = null)
    {
        $this->data[$key] = $value;
        return $this;
    }

    private static function getFilePath($viewName)
    {
        $filePath = str_replace(".", "/", $viewName);
        return VIEW_BASE_PATH.$filePath.".php";
    }

    public function __call($method, $parameters)
    {
        if(starts_with($method, "width"))
        {
            return $this->with(snake_case(substr($method, 4)), $parameters[0]);
        }
        throw new \Exception("Function [$method] does not exist!");
    }
}
