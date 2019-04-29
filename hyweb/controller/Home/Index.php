<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/2
 * Time: 下午4:16
 */
namespace hyweb\controller\Home;
use hy\annotation\Autowired;
use hy\utils\Config;
use hy\utils\Session;
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
        $menu = Session::get("menu");
        $newMenu = $this->getChildren($menu, 0);
        $view = View::make("Home.Index.index")
                ->with("newMenu", $newMenu);
        $view->process($view);
    }

    public function getChildren($list, $pid) {
        $returnArr = [];
        if (!empty ($list)) {
            foreach ($list as $key => $val) {
                if ($val['pid'] == $pid) {
                    $val['children'] = $this->getChildren($list, $val['id']);
                    $returnArr[] = $val;
                }
            }
        }
        return $returnArr;
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