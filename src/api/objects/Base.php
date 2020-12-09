<?php
Class Base {
    private $conn;
    private $tableName = "base";

    public $code;
    public $examType;
    public $specialCat;
    public $positions;
    public $year;
    public $baseFirst;
    public $baseLast;

    public function __construct($db) {
        $this->conn = $db;
    }

    function readByYear($year){
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=?";
        $stmt = $this->conn->prepare($query);
        $year = htmlspecialchars(strip_tags($year));
        $stmt->bind_param('s', $year);
        $stmt->execute();
        return $stmt;
    }

    function readByYearAndDept($year, $dept) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=? and code=?";
        $stmt = $this->conn->prepare($query);
        $year = htmlspecialchars(strip_tags($year));
        $dept = htmlspecialchars(strip_tags($dept));
        $stmt->bind_param('ss', $year, $dept);
        $stmt->execute();
        return $stmt;
    }

    function readByDept($dept) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE code=?";
        $stmt = $this->conn->prepare($query);
        $dept = htmlspecialchars(strip_tags($dept));
        $stmt->bind_param('i', $dept);
        $stmt->execute();
        return $stmt;
    }
}
