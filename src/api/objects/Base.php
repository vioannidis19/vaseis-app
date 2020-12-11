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
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=? AND code=?";
        $stmt = $this->conn->prepare($query);
        $year = htmlspecialchars(strip_tags($year));
        $dept = htmlspecialchars(strip_tags($dept));
        $stmt->bind_param('ss', $year, $dept);
        $stmt->execute();
        return $stmt;
    }

    function readByDept($dept) {
        if (isset($_GET["type"])) {
            if ($_GET["type"] == "gel-ime-gen") {
                $query = "SELECT * FROM " . $this->tableName . " WHERE code=? and title like 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' and title not like 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' ORDER BY year asc";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $dept);
                $stmt->execute();
            } elseif ($_GET["type"] == "epal-ime-gen") {
                $query = "SELECT * FROM " . $this->tableName . " where code = ? and ((title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or title like 'ΕΠΑΛ ΝΕΟ') and title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') order by year";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $dept);
                $stmt->execute();
            } else {
                http400();
                return -1;
            }
        } elseif (isset($_GET)) {
            http400();
            return -1;
        }
        else {
            $query = "SELECT * FROM " . $this->tableName . " WHERE code=?";
            $stmt = $this->conn->prepare($query);
            $dept = htmlspecialchars(strip_tags($dept));
            $stmt->bind_param('i', $dept);
            $stmt->execute();
        }
        return $stmt;
    }
}
