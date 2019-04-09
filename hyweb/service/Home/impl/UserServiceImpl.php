<?php
namespace hyweb\service\Home\impl;

use hyweb\service\Home\UserService;
use hy\annotation\Transactional;
use hy\annotation\Autowired;

class UserServiceImpl implements UserService {

    /**
     * @Autowired(class = "\hyweb\model\Home\UserModel")
     */
    private $mod;

    /**
     * @Transactional
     * 事物service
     */
    function updateUser()
    {
        try {
            $result = $this->mod->delete(["id" => 2]);

//            $result = $this->mod->insert([
//                "username" => "ceshi1",
//                "password" => "admin",
//                "age" => 23,
//                "height" => 178,
//                "price" => 200.68
//            ]);

            //$result = $this->mod->update(["id" => 2, "price" => 10]);
            $result = $this->mod->myupdate(["id" => 1, "name" => "zhangsans"]);
            //$result = $this->mod->getAll(["page" => 0, "pageSize" => 10]);
           return $result;
            //$this->mod->canupdate(["id" => 1, "price" => 20]);
            //var_dump($result);
        } catch (\Exception $exception) {
            echo "异常了!";
            throw new \Exception();
        }
//        $list = $this->mod->getAll(["page" => 0, "pageSize" => 10]);
//        p($list);
        // TODO: Implement updateUser() method.
    }

    public function getOne($param) {
        return $this->mod->getOne($param);
    }

    public function selectById($param) {
        return $this->mod->selectById($param);
    }

    public function updateName($arr) {
        return $this->mod->updateName($arr);
    }

    /**
     * 测试事物回滚
     * @Transactional
     */
    public function testTransactional() {
        $this->mod->myupdate(["id" => 1, "name" => "zhangsans"]);
        $this->mod->update(["id" => 2, "price" => 10]);
    }
}