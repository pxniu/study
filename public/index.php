<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/2
 * Time: 下午3:53
 */
$loader = include "../vendor/autoload.php";
use Hy\Routing\Router as Router;
use Doctrine\Common\Annotations\AnnotationRegistry;
AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
Router::run();