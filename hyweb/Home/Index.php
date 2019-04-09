<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/2
 * Time: 下午4:16
 */
namespace Hyweb\home;
use Hy\Routing\Autowired;

class Index {

    /**
     * @Autowired(class = "\Hyweb\service\Home\impl\UserServiceImpl")
     */
    private $service;

    /**
     * @Autowired(class = "\Hyweb\service\Home\impl\PayServiceImpl")
     */
    private $payService;

    public function index() {
        p($this->payService->getAll());

        //$list = $this->service->updateUser();
        //p($list);
        $info = $this->service->getOne(["id" => 1]);
        p($info);
        /*p($info);*/
        //$this->service->updateUser();
    }
}