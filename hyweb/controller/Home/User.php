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
            $insertArr = [
                "roleid" => I("roleid"),
                "username" => I("username"),
                "isboss" => I("isboss"),
                "password" => password_hash(I("password"), PASSWORD_BCRYPT),
                "nickname" => I("nickname")
            ];
            if ($this->userService->insert($insertArr)) {
                JsonData::success();
            } else {
                JsonData::fail();
            }
        } else {
            $list = $this->roleService->getAll();
            $view = View::make("Home.User.add")
                    ->with("list", $list);
            $view->process($view);
        }
    }

    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            p($_POST);
        } else {
            $id = I("id");
            $info = $this->userService->selectById(["id" => $id]);
            $list = $this->roleService->getAll();
            $view = View::make("Home.User.edit")
                    ->with("info", $info)
                    ->with("list", $list);
            $view->process($view);
        }
    }

    public function checkAddUser() {
        $username = I("username");
        $info = $this->userService->selectByUsername(["username" => $username]);
        if (!empty ($info)) {
            echo "false";
        } else {
            echo "true";
        }
    }
}