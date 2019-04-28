<?php
/**
 * Created by PhpStorm.
 * User: haoyu
 * Date: 2019/4/9
 * Time: 上午9:07
 */
namespace hy\handler;

use hy\utils\Config;

class PdoInstance {

    public static $_instance;

    public $_pdo;

    private function __construct()
    {
        try {
            Config::get("db.master", "host");
            $this->_pdo = new \PDO("mysql:host=localhost;dbname=newmvc", "root", "root");
            $this->_pdo->exec("set names utf8");
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e)
        {
            throw new \Exception($e->getMessage());
        }
    }

    public static function getInstance() {
        if (! isset(self::$_instance))
        {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function setPdo($pdo) {
        $this->_pdo = $pdo;
    }

    public function getPdo() {
        return $this->_pdo;
    }

    public function transactional() {
        $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
    }
}