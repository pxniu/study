<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 上午10:45
 */
namespace hyweb\service\Home;
interface RoleService {

    /**
     * 添加角色
     * @param array $arr
     * @return mixed
     */
    function add(Array $arr);

    /**
     * 获取所有角色
     * @return mixed
     */
    function getAll();

    /**
     * 根据主键id查询角色
     * @param array $arr
     * @return mixed
     */
    function selectById(Array $arr);

    /**
     * 根据条件查询角色
     * @param array $arr
     * @return mixed
     */
    function getAllByExcemples(Array $arr);

    /**
     * 角色删除
     * @param array $arr
     * @return mixed
     */
    function delete(Array $arr);
}