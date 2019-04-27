<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/2
 * Time: 下午3:53
 */
declare(strict_types=1);
$loader = include "../vendor/autoload.php";
use hy\routing\Router as Router;
use Doctrine\Common\Annotations\AnnotationRegistry;
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

include "../hy/utils/Func.php";


define("BASE_DIR", dirname(dirname(__FILE__)));
define("VIEW_BASE_PATH", "view/");
define("CONF_BASE_PATH", dirname(__FILE__)."/conf/");

\hy\error\ErrorCatch::run();

Router::run();