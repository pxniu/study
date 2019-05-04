<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/30
 * Time: 下午3:15
 */
namespace hyweb\model\Home;
use hy\annotation\Insert;

class CategoryModel {
    /**
     * @Insert(sql = "insert into category (cat_name, parent_id, cat_desc, sort, is_show, addtime) values ({cat_name}, {parent_id}, {cat_desc}, {sort}, {is_show}, now())")
     */
    public function insert() {

    }
}