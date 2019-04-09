<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 上午11:19
 */
namespace hyweb\service\Home\impl;
use \hy\annotation\Autowired;
use hyweb\service\Home\PayService;

class PayServiceImpl implements PayService {

    /**
     * @Autowired(class = "\hyweb\model\Home\PayModel")
     */
    private $mod;

    function getAll()
    {
        $a = $this->mod->getAll();
        return $a;
        // TODO: Implement getAll() method.
    }
}