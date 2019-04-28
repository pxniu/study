<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/7
 * Time: 上午2:37
 */
namespace hyweb\service\Home;

interface UserService {

    /**
     * 根据条件查询用户
     * @param array $selectArr
     * @return mixed
     */
    function selectByLimit(Array $selectArr);

    /**
     * 根据主键id查询
     * @param int $id
     * @return mixed
     */
    function selectById(Array $arr);

    /**
     * 根据账号查询用户
     * @param array $selectArr
     * @return mixed
     */
    public function selectByUsername(Array $selectArr);

    /**
     * 添加用户
     * @param array $insertArr
     * @return mixed
     */
    public function insert(Array $insertArr);
}