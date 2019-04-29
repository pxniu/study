<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/28
 * Time: 下午1:28
 */
namespace hyweb\controller\Common;

use hy\utils\Session;
use hy\annotation\Autowired;

class CheckAuth {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\PermissionServiceImpl")
     */
    private $_modPermissionService;

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\UserServiceImpl")
     */
    private $_modUserService;

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\RolePermissionServiceImpl")
     */
    private $_modRolePermissionService;

    public function run() {

        $currentMenu = strtolower(GROUP_NAME."/".MODULE_NAME."/".ACTION_NAME);

        $uid = Session::get("uid");
        $menu = "";
        $userInfo = [];
        if ($uid) {
            if (!Session::get("ids") || !Session::get("auth") || !Session::get("menu")) {
                $userInfo = $this->_modUserService->selectById(["id" => $uid]);
                if (empty ($userInfo)) {
                    die("用户不存在!");
                }

                $permissionsAll = $this->_modPermissionService->getAll();
                $permissions = [];
                $ids = [];
                if (!empty ($permissionsAll)) {
                    foreach ($permissionsAll as $key => $val) {
                        $permissions[] = $val['id'];
                        $ids[strtolower($val['url'])] = $val['id'];
                    }
                }

                $rolePermissionAll = $this->_modRolePermissionService->selectByRoleId(["roleid" => $userInfo['roleid']]);
                $rolePermission = explode(",", $rolePermissionAll['menuIds']);
                $auth = array_diff($permissions, $rolePermission);
                $menuIds = array_intersect($permissions, $rolePermission);
                $menu = [];
                if (!empty ($permissionsAll)) {
                    foreach ($permissionsAll as $key => $val) {
                        if (in_array($val['id'], $menuIds)) {
                            $menu[] = $val;
                        }
                    }
                }

                Session::set("menu", $menu);
                Session::set("ids", $ids);
                Session::set("auth", $auth);
            }
        }

        if (!empty ($userInfo) && $userInfo['isboss'] != 1) {
            $sids = Session::get("ids");
            $sauth = Session::get("auth");


            if (isset($sids[$currentMenu])) {
                if (in_array($sids[$currentMenu], $sauth)) {
                    die("无权限访问!");
                }
            }
        }
    }
}