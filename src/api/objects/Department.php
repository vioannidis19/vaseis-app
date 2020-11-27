<?php

class Department {
    private $conn;
    private $tableName = "dept";

    public $code;
    public $name;
    public $uniId;
    public $uniName;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readByCode() {
        $query = "SELECT * FROM " . $this->tableName . " WHERE code=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $this->code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(!$row) {
            $this->name = null;
            $this->uniId = null;
        }else {
            $this->name = $row["name"];
            $this->uniId = $row["uni_id"];
        }
    }

    function readByUniId($uniId) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE uni_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $uniId);
        $stmt->execute();
        return $stmt;
    }
}
