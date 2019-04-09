<?php
namespace Hyweb\service\Home\impl;

use Hyweb\service\Home\UserService;
use Hy\Routing\Transactional;
use Hy\Routing\Autowired;

class UserServiceImpl implements UserService {

    /**
     * @Autowired(class = "\Hyweb\Model\Home\UserModel")
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
}