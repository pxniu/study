<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/28
 * Time: 下午1:25
 */
namespace hyweb\controller\Common;
use hy\annotation\Autowired;
use hy\utils\Session;

class CheckLogin {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\UserServiceImpl")
     */
    private $_modUserService;

    public function run() {
        $admin = Session::get("uid");
        $list = $this->_modUserService->selectById(["id" => 1]);
        $allowUrl = [
            "home/login/index",
            "home/login/checkusername"
        ];
        $domain = strtolower(GROUP_NAME."/".MODULE_NAME."/".ACTION_NAME);

        if (strtolower(GROUP_NAME) == "home" && empty ($admin) && !in_array($domain, $allowUrl)) {
            header("Location:/Home/Login/index");
            exit();
        }

    }
}