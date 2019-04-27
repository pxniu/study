<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午3:28
 */
namespace hyweb\server\Home;

interface User {

    /**
     * 分页查询
     * @param array $selectArr
     * @return mixed
     */
    public function selectByLimit(Array $selectArr);
}