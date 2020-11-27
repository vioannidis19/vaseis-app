<?php

class SpecialCategory
{
    private $conn;
    private $tableName = "specialcat";

    public $code;
    public $title;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
