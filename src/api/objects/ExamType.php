<?php

class ExamType
{
    private $conn;
    private $tableName = "examtype";

    public $title;
    public $description;

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
