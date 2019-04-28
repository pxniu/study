<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午9:16
 */
namespace hyweb\controller\Home;

use hy\utils\Ercode;
use hy\utils\JsonData;
use hy\utils\Session;
use hy\view\View;
use hy\annotation\Autowired;

class Login {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\UserServiceImpl")
     */
    private $_modUserSerivce;

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $username = I("username");
            $password = I("password");
            $info = $this->_modUserSerivce->selectByUsername(["username" => $username]);
            if (empty ($info)) {
                JsonData::fail("账号不存在");
            }
            if (password_verify($password, $info['password'])) {
                Session::set("uid", $info['id']);
                JsonData::success();
            } else {
                JsonData::fail("密码不正确!");
            }
        } else {
            $view = View::make("Home.Login.index");
            $view->process($view);
        }

    }

    public function checkUsername() {
        $username = I("username");
        $info = $this->_modUserSerivce->selectByUsername(["username" => $username]);
        if (empty ($info)) {
            echo "false";
        } else {
            echo "true";
        }
    }
}