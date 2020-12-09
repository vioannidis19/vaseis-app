<?php
class Statistic
{
    public $conn;
    private $tableName = "statistics";

    public $code;
    public $examType;
    public $category;
    public $preference;
    public $count;
    public $year;

    public  function __construct($db) {
        $this->conn = $db;
    }

    function readByYearUniAndCategory($year, $uniId, $category)
    {
        $deptCode = $uniId;
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=? AND category=? AND code=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss', $year, $category, $deptCode);
        $stmt->execute();
        return $stmt;
    }

    function readByYearDeptAndCategory($year, $deptId, $category) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE code=? AND year=? AND category=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss', $deptId, $year, $category);
        $stmt->execute();
        return $stmt;
    }

    function readByYearAndDept($year, $deptId) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=? AND code=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $year, $deptId);
        $stmt->execute();
        return $stmt;
    }

    function readByDeptAndCategory($deptId, $category) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE code=? AND category=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $deptId, $category);
        $stmt->execute();
        return $stmt;
    }

    function readByYearAndCategory($year, $category) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=? AND category=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ss', $year, $category);
        $stmt->execute();
        return $stmt;
    }

    function readByYear($year) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $year);
        $stmt->execute();
        return $stmt;
    }

    function readByDepartment($deptId) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE code=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $deptId);
        $stmt->execute();
        return $stmt;
    }
}
