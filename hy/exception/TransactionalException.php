<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 下午4:03
 */
namespace hy\exception;

class TransactionalException extends \Exception {

    public function __construct($message, $code=0){
        parent::__construct($message, $code);
    }
    public function __toString() {
        return __CLASS__.":[".$this->code."]:".$this->message;
    }
}