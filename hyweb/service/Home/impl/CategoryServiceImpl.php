<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/30
 * Time: 下午3:18
 */
namespace hyweb\service\Home\impl;

use hyweb\service\Home\CategoryService;
use hy\annotation\Autowired;

class CategoryServiceImpl implements CategoryService {

    /**
     * @Autowired(class = "\hyweb\model\Home\CategoryModel")
     */
    private $_mod;

    /**
     * 商品分类添加
     * @param array $insertArr
     * @return mixed
     */
    function insert(Array $insertArr)
    {
        return $this->_mod->insert($insertArr);
    }
}