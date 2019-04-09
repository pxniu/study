<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 上午11:20
 */
namespace hyweb\model\Home;
use hy\annotation\Select;

class PayModel {

    /**
     * @Select("select * from pay")
     */
    public function getAll() {

    }
}