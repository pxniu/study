<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午9:16
 */
namespace hyweb\controller\Home;

use hy\utils\Ercode;
use hy\view\View;

class Login {

    public function index() {

        $view = View::make("Home.Login.index");
        $view->process($view);
    }

    public function logindo() {
        echo 123;
    }
}