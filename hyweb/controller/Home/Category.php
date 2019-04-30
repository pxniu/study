<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/30
 * Time: 上午9:42
 */
namespace hyweb\controller\Home;

use hy\utils\JsonData;
use hy\view\View;

class Category {

    public function index() {
        $view = View::make("Home.Category.index");
        $view->process($view);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

        } else {
            $view = View::make("Home.Category.add");
            $view->process($view);
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

        } else {
            $view = View::make("Home.Category.edit");
            $view->process($view);
        }
    }

    public function json() {
        $list = [
            [
                "id" => 1,
                "pid" => -1,
                "sex" => "男",
                "name" => "父亲"
            ],
            [
                "id" => 2,
                "pid" => 1,
                "sex" => "女",
                "name" => "儿子"
            ]
        ];
        JsonData::jsonList($list, 2);
    }
}