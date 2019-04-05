<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/4
 * Time: 上午11:33
 */
namespace Hyweb\Model\Home;
use Hy\Routing\Select;

class UserModel {

    /**
     * @Select(sql = "select * from {$tableName} where id = {$id} and name = {$name}")
     */
    public function select() {

    }

}