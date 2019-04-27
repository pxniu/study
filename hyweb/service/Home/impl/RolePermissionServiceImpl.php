<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/24
 * Time: 下午1:49
 */
namespace hyweb\service\Home\impl;

use hyweb\service\Home\RolePermissionService;
use hy\annotation\Autowired;

class RolePermissionServiceImpl implements RolePermissionService {

    /**
     * @Autowired(class = "\hyweb\model\Home\RolePermissionModel")
     */
    private $_mod;

    /**
     * 角色权限关联表添加
     * @return mixed
     */
    public function add(Array $arr)
    {
        return $this->_mod->add($arr);
    }

    /**
     * 根据角色id获取所有权限id
     * @param array $arr
     * @return mixed
     */
    public function selectByRoleId(Array $arr)
    {
        return $this->_mod->selectByRoleId($arr);
    }

    /**
     * 根据角色id删除权限id
     * @param array $arr
     * @return mixed
     */
    public function deleteByRoleId(Array $arr)
    {
        return $this->_mod->deleteByRoleId($arr);
    }
}