<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午1:42
 */
namespace hyweb\model\Home;
use hy\annotation\Insert;
use hy\annotation\Select;
use hy\annotation\SelectOne;

class PermissionModel {
    /**
     * @Insert(
          sql =
          "insert into permission
          (name, url, pid, sort, isshow, icon, addtime) values
          ({name}, {url}, {pid}, {sort}, {isshow}, {icon}, now())"
     * )
     */
    public function add() {

    }

    /**
     * @Select(sql = "select * from permission")
     */
    public function getAll() {

    }

    /**
     * @Select(sql = "select id, pid as pId, name from permission")
     */
    public function getTreeList() {

    }

    /**
     * @SelectOne(sql = "select name from permission where id = {id}")
     */
    public function selectById() {

    }
}