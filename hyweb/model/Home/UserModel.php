<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/4
 * Time: 上午11:33
 */
namespace hyweb\model\Home;
use hy\annotation\Select;
use hy\annotation\Update;
use hy\annotation\Insert;
use hy\annotation\Delete;
use hy\annotation\SelectOne;

class UserModel {

    /**
     * @Select(sql = "select * from user where username = {username}")
     */
    public function select() {

    }

    /**
     * @Select(sql = "select * from user where id = {id}")
     */
    public function selectById() {

    }

    /**
     * @Select(sql = "select a.* from user as a left join pay as b on a.uid = b.uid where b.price > {price} and a.username = {username}")
     */
    public function selects() {

    }

    /**
     * @Select(sql = "select * from user limit {page}, {pageSize}")
     */
    public function getAll() {

    }

    /**
     * @Update(sql = "update user set username = {name} where id = {id}")
     */
    public function myUpdate() {

    }

    /**
     * @Update(sql = "update user set price = price + {price} where id = {id}")
     */
    public function update() {

    }

    /**
     * @Update(sql = "update user set price = price + {price} where id = {id}")
     */
    public function canupdate() {

    }

    /**
     * @Insert(sql = "insert into user (username, password, age, height, price, addtime) values ({username}, {password}, {age}, {height}, {price}, now())")
     */
    public function insert() {

    }

    /**
     * @Delete(sql = "delete from user where id = {id}")
     */
    public function delete() {

    }

    /**
     * @SelectOne(sql = "select * from user where id = {id}")
     */
    public function getOne() {

    }

    /**
     * @Update(sql = "update user set username = {username} where id = {id}")
     */
    public function updateName() {

    }
}