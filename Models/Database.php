<?php

namespace Models;

class Database 
{
    private $host = "localhost";
    private $dbname = "SPP";
    private $user = "root";
    private $password = "";
    public $conn = null;

    public function connect() {

        try {
            $this->conn = new \PDO("mysql:host={$this->host};dbname={$this->dbname}",$this->user,$this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die('Connection Error' . $e->getMessage);
        }

        return $this->conn;

    }

}


?>