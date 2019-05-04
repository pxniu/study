<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/30
 * Time: 下午3:17
 */
namespace hyweb\service\Home;

interface CategoryService {

    /**
     * 商品分类添加
     * @param array $insertArr
     * @return mixed
     */
    function insert(Array $insertArr);
}