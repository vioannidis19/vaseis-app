<?php
class Database{
    private $host = '';
    private $dbName = '';
    private $username = '';
    private $password = '';
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbName);
            $this->conn->set_charset("utf8mb4");
        }catch (Exception $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
