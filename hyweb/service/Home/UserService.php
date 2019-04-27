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
}