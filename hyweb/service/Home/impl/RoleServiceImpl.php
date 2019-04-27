<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午10:46
 */
namespace hyweb\service\Home\impl;

use hy\exception\TransactionalException;
use hyweb\service\Home\RoleService;
use hy\annotation\Autowired;
use hy\annotation\Transactional;

class RoleServiceImpl implements RoleService {

    /**
     * @Autowired(class = "\hyweb\model\Home\RoleModel")
     */
    private $_mod;

    /**
     * @Autowired(class = "\hyweb\model\Home\RolePermissionModel")
     */
    private $_modRolePermission;

    /**
     * @Transactional
     */
    function add(Array $arr)
    {
        try {
            $roleId = $this->_mod->add($arr);
            $ids = explode(",", $arr['menuIds']);
            $this->_modRolePermission->add([
                "roleId" => $roleId,
                "list" => $ids
            ]);
            return true;
        } catch (\Exception $exception) {
            throw new TransactionalException();
        }
    }

    /**
     * @Transactional
     */
    function update(Array $arr) {
        try {
            $this->_mod->update($arr);
            $this->_modRolePermission->deleteByRoleId($arr);
            $ids = explode(",", $arr['menuIds']);
            $this->_modRolePermission->add([
                "roleId" => $arr['roleid'],
                "list" => $ids
            ]);
            return true;
        } catch (\Exception $exception) {
            p($exception);
            throw new TransactionalException();
        }
    }

    /**
     * 获取所有角色
     * @return mixed
     */
    function getAll()
    {
        return $this->_mod->getAll();
    }

    /**
     * 根据条件查询角色
     * @param array $arr
     * @return mixed
     */
    function getAllByExcemples(Array $arr)
    {
        return $this->_mod->getAllByExcemples($arr);
    }

    /**
     * 根据主键id查询角色
     * @param array $arr
     * @return mixed
     */
    function selectById(Array $arr)
    {
        return $this->_mod->selectById($arr);
    }

    /**
     * @Transactional
     */
    function delete(Array $arr)
    {
        try {
            $this->_mod->delete($arr);
            $this->_modRolePermission->deleteByRoleId(["roleid" => $arr['id']]);
            return true;
        } catch (\Exception $exception) {
            throw new TransactionalException();
        }
    }
}