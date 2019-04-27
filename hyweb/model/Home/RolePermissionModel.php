<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/24
 * Time: 下午1:46
 */
namespace hyweb\model\Home;
use hy\annotation\Insert;
use hy\annotation\SelectOne;
use hy\annotation\Delete;

class RolePermissionModel {

    /**
     * @Insert(sql = "
        insert into role_permission (roleid, permissionid) values
        <foreach collection='list'>
        ({roleId}, #ids#)
        </foreach>
     ")
     */
    public function add() {

    }

    /**
     * @SelectOne(sql = "select group_concat(permissionid) as menuIds from role_permission where roleid = {roleid} group by roleid")
     */
    public function selectByRoleId() {

    }

    /**
     * @Delete(sql = "delete from role_permission where roleid = {roleid}")
     */
    public function deleteByRoleId() {

    }
}