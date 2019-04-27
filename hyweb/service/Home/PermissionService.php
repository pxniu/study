<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午1:44
 */
namespace hyweb\service\Home;

interface PermissionService {

    /**
     * 菜单添加
     * @param array $insertArr
     * @return mixed
     */
    public function add(Array $insertArr);

    /**
     * 获取所有菜单
     * @return mixed
     */
    public function getAll();

    /**
     * 获取角色授权列表
     * @return mixed
     */
    public function getTreeList();

    /**
     * 根据主键id查询菜单
     * @return mixed
     */
    public function selectById(Array $selectArr);
}