<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/2
 * Time: 下午4:16
 */
namespace hyweb\home;
use hy\annotation\Autowired;
use hy\utils\Config;
use hy\view\View;

class Index {

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\UserServiceImpl")
     */
    private $service;

    /**
     * @Autowired(class = "\hyweb\service\Home\impl\PayServiceImpl")
     */
    private $payService;

    public function index() {
        echo Config::get("db.master", "host");
        p($this->payService->getAll());
        //$info = $this->service->getOne(["id" => 1]);
        //p($info);

        //$list = $this->service->updateUser();
        //p($list);
//        $id = $_GET['id'];
//        $info = $this->service->selectById(["id" => $id]);
//        p($info);

        /*p($info);*/
        //$this->service->updateUser();
//        try {
//            $this->service->updateName(["id" => 1, "username" => "zhangsan"]);
//        } catch (\Exception $exception) {
//            echo "更新失败!";
//        }

    }

    public function testTransactional() {
        $result = $this->service->testTransactional();
        var_dump($result);
    }

    public function swagger() {
        //支持跨域
        header('Access-Control-Allow-Origin:*');
        $openapi = \OpenApi\scan('../hyweb/Api');
        echo json_encode($openapi);
    }

    #正则
    public function preg() {
    }

    public function testView() {
        $view = View::make("/Home/Index/testView");
        $view->process($view);
    }

    public function vue() {
        $view = View::make("/Home/Index/vue");
        $view->process($view);
    }
}