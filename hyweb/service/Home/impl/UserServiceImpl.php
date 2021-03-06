<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午3:36
 */
namespace hyweb\service\Home\impl;

use hyweb\service\Home\UserService;
use hy\annotation\Autowired;

class UserServiceImpl implements UserService {

    /**
     * @Autowired(class = "\hyweb\model\Home\UserModel")
     */
    private $_mod;

    /**
     * 根据条件查询用户
     * @param array $selectArr
     */
    function selectByLimit(Array $selectArr)
    {
        return $this->_mod->selectByLimit($selectArr);
    }

    /**
     * 根据主键id查询
     * @param int $id
     * @return mixed
     */
    function selectById(Array $arr)
    {
        return $this->_mod->selectById($arr);
    }

    /**
     * 根据账号查询用户
     * @param array $selectArr
     * @return mixed
     */
    public function selectByUsername(Array $selectArr)
    {
        return $this->_mod->selectByUsername($selectArr);
    }

    /**
     * 添加用户
     * @param array $insertArr
     * @return mixed
     */
    public function insert(Array $insertArr)
    {
        return $this->_mod->insert($insertArr);
    }
}