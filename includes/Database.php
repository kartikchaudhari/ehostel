<?php

class Database {

    private static $db;
    private $connection;

    private function __construct() {
        require "config.php";
        $this->connection = new MySQLi($host,$user,$password,$db_name);
    }

    function __destruct() {
        $this->connection->close();
    }

    public static function getConnection() {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->connection;
    }
}

?>