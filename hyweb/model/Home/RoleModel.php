<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午10:43
 */
namespace hyweb\model\Home;
use hy\annotation\Insert;
use hy\annotation\Select;
use hy\annotation\SelectOne;
use hy\annotation\Update;
use hy\annotation\Delete;

class RoleModel {

    /**
     * @Insert(sql = "insert into role (name, remark, addtime) values ({name}, {remark}, now())")
     */
    public function add() {

    }

    /**
     * @Select(sql = "select * from role")
     */
    public function getAll() {

    }

    /**
     * @Insert(sql = "
        insert into roles (roleId, permissionId) values
          <foreach collection='list' item='r' separator=",">
            ({roleId}, #id#})
          </foreach>
     ")
     */
    public function adds() {

    }

    /**
     * @SelectOne(sql = "select * from role where id = {id}")
     */
    public function selectById() {

    }

    /**
     * @Select(sql = "select * from role <if test='name != null'>where name like %{name}%</if> order by addtime desc limit {start}, {limit}")
     */
    public function getAllByExcemples() {

    }

    /**
     * @Update(sql = "update role set name = {name}, remark = {remark} where id = {roleid}")
     */
    public function update() {

    }

    /**
     * @Delete(sql = "delete from role where id = {id}")
     */
    public function delete() {

    }
}