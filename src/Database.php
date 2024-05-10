<?php

namespace src;
use mysqli;

require "config/db.php";

class Database
{
    private static ?Database $instance = null;
    private mysqli $connection;

    private function __construct()
    {

        $this->connection = new mysqli(SERVER, USERNAME, PASSWORD, DATABASE);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public static function getInstance(): ?Database
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    // Prevent cloning of instance
    private function __clone()
    {
    }

    // Prevent unserialization of instance
    private function __wakeup()
    {
    }
}