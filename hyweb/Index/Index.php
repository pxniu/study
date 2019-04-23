<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/2
 * Time: 下午4:59
 */
namespace hyweb\Index;
use hy\annotation\Autowired;

/**
 * Class Index
 * @package Hyweb\Index
 */
class Index {

    /**
     * @Autowired(class = "\hyweb\model\Home\UserModel")
     */
    private $mod;

    public function index() {
        //$list = $this->mod->select(["id" => 1, "username" => "zhangsan", "email" => "100538260@qq.com"]);
        //p($list);

        $lists = $this->mod->selects(["uid" => 1, "username" => "zhangsan", "price" => 3.2]);

        $all = $this->mod->getAll(["page" => 0, "pageSize" => 2]);
        p($all);
    }
}