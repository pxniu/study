<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午1:45
 */
namespace hyweb\service\Home\impl;

use hyweb\service\Home\PermissionService;
use hy\annotation\Autowired;

class PermissionServiceImpl implements PermissionService {

    /**
     * @Autowired(class = "\hyweb\model\Home\PermissionModel")
     */
    private $_mod;

    public function add(Array $insertArr)
    {
        return $this->_mod->add($insertArr);
    }

    /**
     * 获取所有菜单
     * @return mixed
     */
    public function getAll()
    {
        return $this->_mod->getAll();
    }

    /**
     * 根据主键id查询菜单
     * @return mixed
     */
    public function selectById(Array $selectArr)
    {
        return $this->_mod->selectById($selectArr);
    }

    /**
     * 获取角色授权列表
     * @return mixed
     */
    public function getTreeList()
    {
        return $this->_mod->getTreeList();
    }
}