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
        if (isset($_GET["type"])) {
            if($_GET["type"] == "gel-ime-gen") {
                $query = "SELECT * FROM " . $this->tableName .
                    " WHERE code=? AND year=? AND category=? AND id LIKE 'ΓΕΛ%' AND id NOT LIKE 'ΓΕΛ ΠΑΛΑΙΟ%' ORDER BY year";
            } elseif ($_GET["type"] == "epal-ime-gen") {
                $query = "SELECT * FROM " . $this->tableName .
                    " WHERE code=? AND year=? AND category=? AND id LIKE 'ΕΠΑΛ ΗΜ%' ORDER BY year";
            }
            else {
                http400();
                return -1;
            }
        } else {
            $query = "SELECT * FROM " . $this->tableName . " WHERE code=? AND year=? AND category=?";
        }
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
        if (isset($_GET["type"])) {
            if($_GET["type"] == "gel-ime-gen") {
                $query = "SELECT * FROM " . $this->tableName .
                    " WHERE code=? AND category=? AND id LIKE 'ΓΕΛ%' AND id NOT LIKE 'ΓΕΛ ΠΑΛΑΙΟ%' ORDER BY year";
            } elseif ($_GET["type"] == "epal-ime-gen") {
                $query = "SELECT * FROM " . $this->tableName .
                    " WHERE code=? AND category=? AND id LIKE 'ΕΠΑΛ ΗΜ%' ORDER BY year";
            }
            else {
                http400();
                return -1;
            }
        } else {
            $query = "SELECT * FROM " . $this->tableName . " WHERE code=? AND category=? ORDER BY year";
        }
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
        if (isset($_GET["page"])) $limits = $_GET["page"] * 1000;
        else $limits = 0;
        $query = "SELECT * FROM " . $this->tableName . " WHERE year=? LIMIT " . $limits . ",1000";
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

    function paginate($year) {
        $query = "SELECT COUNT(*) AS count FROM " . $this->tableName . " WHERE year=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $year);
        $stmt->execute();
        $res = $stmt->get_result();
        $count = $res->fetch_assoc();
        $count = $count["count"];
        $pages = ceil($count/1000);
        $links = array();
        $links["links"] = array();
        if (isset($_GET["page"])) {
            $self = array("self" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0] . "?page=" . $_GET["page"]));
            $prev = array("prev" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0] . "?page=" . ($_GET["page"] - 1)));
            $next = array("next" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0] . "?page=" . ($_GET["page"] + 1)));
        } else {
            $self = array("first" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0]));
            $prev = $self;
            $next = array("first" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0] . "?page=" . 2));
        }
        $first = array("first" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0]));
        $last = array("last" => array("href" => "vaseis.iee.ihu.gr/api/statistics/" . $year[0] . "?page=" . $pages));
        array_push($links["links"], $self);
        array_push($links["links"], $first);
        array_push($links["links"], $prev);
        array_push($links["links"], $next);
        array_push($links["links"], $last);
        return $links;
    }

    function readMinYear() {
        $query = "SELECT MIN(year) AS minYear FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readMaxYear() {
        $query = "SELECT MAX(year) AS maxYear FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
