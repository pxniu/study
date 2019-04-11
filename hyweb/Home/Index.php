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
        //$pattern = "/[0-9]/";
        //$subject = "wuuelw9dkfjlk3kj5kjktjg900sdkfkds7v9sa3";
        /*$m1 = $m2 = array();
        $t1 = preg_match($pattern, $subject, $m1);
        $t2 = preg_match_all($pattern, $subject, $m2);
        p($m1);
        p($m2);
        echo "t1:".$t1."<br />";
        echo "t2:".$t2."<br />";*/
        /*$pattern = array("/[0123]/", "/[456]/", "/[789]/");
        //$subject = "wy3klksd4kjk21kjk7jk8lkjs08klsa";
        $replacement = array("慕", "女", "神");
        $subject = array(
            "k3k156l789kjkl0",
            "skdj3k6k8jkk0",
            "sjasi5kj6jkk9j",
            "assdfdafdsf",
            "2323232323"
        );
        $str1 = preg_replace($pattern, $replacement, $subject);
        echo "<hr />";
        $str2 = preg_filter($pattern, $replacement, $subject);
        p($str1);
        p($str2);*/

//        $pattern = "/[0-9]/";
//        $subject = [
//            "weuy",
//            "r3ui",
//            "76as83",
//            "s",
//            "0ck9"
//        ];
//        $arr = preg_grep($pattern, $subject);
//        p($arr);

//        $pattern = "/[0-9]/";
//        $subject = "慕3女2神，5约吗？";
//        $arr = preg_split($pattern, $subject);
//        p($arr);

//        $str = "qwer{asdf}[12345]";
//        $str = preg_quote($str);
//        echo $str;
        $str = "this i s567890 s 
         test a";
        $pattern = "/\D/";
        $boolean = preg_match($pattern, $str, $result);
        p($boolean);
        p($result);

    }

    public function testView() {
        $view = View::make("/Home/Index/testView");
        $view->process($view);
    }
}