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
use hy\annotation\Autowired;

class Category {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\CategoryServiceImpl")
     */
    private $categoryService;

    public function index() {
        $view = View::make("Home.Category.index");
        $view->process($view);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $insertArr = [
                "cat_name" => I("cat_name"),
                "parent_id" => I("parent_id"),
                "cat_desc" => I("cat_desc"),
                "sort" => I("sort"),
                "is_show" => I("is_show")
            ];
            if ($this->categoryService->insert($insertArr)) {
                JsonData::success();
            } else {
                JsonData::fail();
            }
        } else {
            $pid = I("pid");
            if ($pid == 0) {
                $parentName = "根目录";
            } else {
                //$info = $this->permissionService->selectById(["id" => $pid]);
                //$parentName = $info['name'];
            }
            $view = View::make("Home.Category.add")
                    ->with("pid", $pid)
                    ->with("parentName", $parentName);
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