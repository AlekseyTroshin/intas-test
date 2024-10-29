<?php

namespace core;

use PDO;

abstract class Model
{
    public $connection = null;

    public function __construct()
    {
        $db = Db::getInstance();
        $this->connection = $db->pdo;
    }
}