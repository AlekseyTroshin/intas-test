<?php


namespace core;

use PDO;
use PDOException;

class Db
{

    use TSingleton;

    public $pdo = null;
    private function __construct()
    {
        $db = require_once CONFIG . '/config_db.php';

        try {
            $this->pdo = new PDO($db['dsn'], $db['user'], $db['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Ошибка подключения: " . $e->getMessage();
        }
    }

}