<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/23
 * Time: 下午3:27
 */

namespace hyweb\model\Home;
use \hy\annotation\SelectOne;
use \hy\annotation\Select;

class UserModel {


    /**
     * @Select(sql = "select * from user where 1=1 <if test='username != null'> and username like %{username}%</if> <if test='nickname != null'> and nickname like %{nickname}%</if> limit {start}, {limit}")
     */
    public function selectByLimit() {

    }

    /**
     * @SelectOne(sql = "select * from user where id = {id}")
     */
    public function selectById() {

    }

    /**
     * @Select("
    select * from user where 1=1
    <if test='age == 20'>年龄</if>
    <if test='username != NULL'> and username like '%{username}%'</if>
    <if test='password != null'> and password = {password}</if>
    <if test='email != 100538260@qq.com'> and nihaoa </if>
    <if test='height > 200'>身高2米以上</if>
    limit {page}, {pageSize}
    ")
     */
    /**
     * @SelectOne("
    select * from user where 1=1
    <if test='username != NULL'> and username like %{username}%</if>
    <if test='nickname != null'> and nickname like %{nickname}</if>
    limit {page}, {pageSize}
    ")
     */
    public function selectDemo() {

    }
}