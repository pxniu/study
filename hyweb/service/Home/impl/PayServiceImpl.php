<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 上午11:19
 */
namespace Hyweb\service\Home\impl;
use \Hy\Routing\Autowired;

class PayServiceImpl implements \Hyweb\service\Home\PayService {

    /**
     * @Autowired(class = "\Hyweb\Model\Home\PayModel")
     */
    private $mod;

    function getAll()
    {
        $a = $this->mod->getAll();
        return $a;
        // TODO: Implement getAll() method.
    }
}