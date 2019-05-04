<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午10:39
 */
namespace hyweb\controller\Home;

use hy\exception\TransactionalException;
use hy\utils\HRedis;
use hy\utils\JsonData;
use hy\utils\Session;
use hy\view\View;
use hy\annotation\Autowired;

/**
 * 角色控制器
 * Class Role
 * @package hyweb\controller\Home
 */
class Role {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\PermissionServiceImpl")
     */
    private $permissionService;

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\RoleServiceImpl")
     */
    private $roleService;

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\RolePermissionServiceImpl")
     */
    private $rolePermissionService;

    /**
     * 角色列表
     */
    public function index() {
        $view = View::make("Home.Role.index");
        $view->process($view);
    }

    /**
     * 获取角色列表数据
     */
    public function getList() {
        $page = I("page");
        $name = I("name");
        $start = ($page - 1) * 20;
        $arr = [
            "name" => $name,
            "start" => $start,
            "limit" => 20
        ];

        $list = $this->roleService->getAllByExcemples($arr);
        JsonData::jsonList($list, count($list));
    }

    /**
     * 角色添加页面
     */
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $arr = [
                "name" => I("name"),
                "remark" => I("remark"),
                "menuIds" => I("menuIds")
            ];
            if ($this->roleService->add($arr)) {
                JsonData::success();
            } else {
                JsonData::fail();
            }
        } else {
            $view = View::make("Home.Role.add");
            $view->process($view);
        }
    }

    /**
     * 角色修改
     */
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $arr = [
                "roleid" => I("id"),
                "name" => I("name"),
                "remark" => I("remark"),
                "menuIds" => I("menuIds")
            ];
            if ($this->roleService->update($arr)) {
                JsonData::success();
            } else {
                JsonData::fail();
            }
        } else {
            $id = I("id");
            $info = $this->roleService->selectById(["id" => $id]);
            $menus = $this->rolePermissionService->selectByRoleId(["roleid" => $id]);
            $view = View::make("Home.Role.edit")
                    ->with("info", $info)
                    ->with("menuIds", $menus['menuIds']);
            $view->process($view);
        }
    }

    /**
     * 角色删除
     */
    public function delete() {
        $id = I("id");
        if ($this->roleService->delete(["id" => $id])) {
            JsonData::success();
        } else {
            JsonData::fail();
        }
    }

    /**
     * 获取权限列表
     */
    public function getTree() {
        $list = $this->permissionService->getTreeList();
        $newList = $this->getChildren($list);
        JsonData::jsonList($newList);
    }

    /**
     * 递归获取子
     * @param $list
     * @param int $pid
     * @return array
     */
    public function getChildren($list, $pid = 0) {
        $returnArr = [];
        if (!empty ($list)) {
            foreach ($list as $key => $val) {
                if ($val['pId'] == $pid) {
                    $val['spread'] = true;
                    $val['children'] = $this->getChildren($list, $val['id']);
                    $returnArr[] = $val;
                }
            }
        }
        return $returnArr;
    }

    /**
     * 递归排序
     * @param $list
     * @param int $pid
     * @param int $level
     * @return array
     */
    public function getTrees($list, $pid = 0, $level = 0) {
        $returnArr = array();
        if (!empty ($list)) {
            foreach ($list as $key => $val) {
                if ($val['pId'] == $pid) {
                    $val['level'] = $level;
                    $returnArr[] = $val;
                    $returnArr = array_merge($returnArr, $this->getTrees($list, $val['id'], $level + 1));
                }
            }
        }
        return $returnArr;
    }

    public function testClient() {
        $redis = new HRedis();
        $redis->publish("test","nihaoa");
    }
}