<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午11:09
 */
namespace hyweb\controller\Home;

use hy\utils\JsonData;
use hy\utils\Method;
use hy\view\View;
use hy\annotation\Autowired;

class Permission {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\PermissionServiceImpl")
     */
    private $permissionService;

    public function index() {
        $list = $this->permissionService->getAll();
        $newList = $this->getTrees($list);
        $view = View::make("Home.Permission.index")
                ->with("newList", $newList);
        $view->process($view);
    }

    public function add() {
       if ($_SERVER['REQUEST_METHOD'] == "POST") {
           $name = I("name");
           $url = I("url");
           $pid = I("pid");
           $sort = I("sort");
           $icon = I("icon");
           $isshow = I("isshow");

           $insertArr = [
               "name" => $name,
               "url" => $url,
               "pid" => $pid,
               "sort" => $sort,
               "icon" => $icon,
               "isshow" => $isshow
           ];

           if ($this->permissionService->add($insertArr)) {
               JsonData::success();
           } else {
               JsonData::fail();
           }

       } else {
           $pid = I("pid");
           if ($pid == 0) {
               $parentName = "根目录";
           } else {
               $info = $this->permissionService->selectById(["id" => $pid]);
               $parentName = $info['name'];
           }
           $view = View::make("Home.Permission.add")
                    ->with("parentName", $parentName)
                    ->with("pid", $pid);
           $view->process($view);
       }
    }

    public function getTree() {

        $list = $this->permissionService->getAll();
        $newList = $this->getChildren($list, 0);
        $returnArr = [[
            "name" => "根目录",
            "id" => 0,
            "spread" => true,
            "children" => $newList
        ]];
        return JsonData::success($returnArr);
    }

    public function getChildren($list, $pid) {
        $returnArr = [];
        if (!empty ($list)) {
            foreach ($list as $key => $val) {
                if ($val['pid'] == $pid) {
                    $val['spread'] = true;
                    $val['children'] = $this->getChildren($list, $val['id']);
                    $returnArr[] = $val;
                }
            }
        }
        return $returnArr;
    }

    public function getTrees($list, $pid = 0, $level = 0) {
        $returnArr = array();
        if (!empty ($list)) {
            foreach ($list as $key => $val) {
                if ($val['pid'] == $pid) {
                    $val['level'] = $level;
                    $returnArr[] = $val;
                    $returnArr = array_merge($returnArr, $this->getTrees($list, $val['id'], $level + 1));
                }
            }
        }
        return $returnArr;
    }
}