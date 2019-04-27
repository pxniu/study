<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午3:25
 */
namespace hyweb\controller\Home;
use hy\annotation\Autowired;

use hy\utils\JsonData;
use hy\view\View;

class User {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\UserServiceImpl")
     */
    private $userService;

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\RoleServiceImpl")
     */
    private $roleService;

    public function index() {
        ini_set("display_errors", 1);
//        $list = $this->userService->selectByLimit([
//            "page" => 0,
//            "pageSize" => 20,
//            "limit" => 10,
//            "username" => "wang",
//            "nickname" => "1",
//            "password" => "admin",
//            "email" => "100538260@qq.com",
//            "age" => 20,
//            "height" => 201
//        ]);
//        p($list);

        $view = View::make("Home.User.index");
        $view->process($view);
    }

    public function getList() {
        $page = I("page");
        $username = I("username");
        $nickname = I("nickname");
        $start = ($page - 1) * 20;
        $arr = [
            "username" => $username,
            "nickname" => $nickname,
            "start" => $start,
            "limit" => 20
        ];

        $list = $this->userService->selectByLimit($arr);
        JsonData::jsonList($list, count($list));
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

        } else {
            $view = View::make("Home.User.add");
            $view->process($view);
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

        } else {
            $id = I("id");
            $info = $this->userService->selectById(["id" => $id]);
            $view = View::make("Home.User.edit")
                    ->with("info", $info);
            $view->process($view);
        }
    }
}