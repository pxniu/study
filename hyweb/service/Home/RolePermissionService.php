<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/24
 * Time: 下午1:48
 */
namespace hyweb\service\Home;

interface RolePermissionService {

    /**
     * 角色权限关联表添加
     * @return mixed
     */
    public function add(Array $arr);

    /**
     * 根据角色id获取所有权限id
     * @param array $arr
     * @return mixed
     */
    public function selectByRoleId(Array $arr);

    /**
     * 根据角色id删除权限id
     * @param array $arr
     * @return mixed
     */
    public function deleteByRoleId(Array $arr);
}