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
        $details = false;
        if (isset($_GET["details"])) {
            if ($_GET["details"] == "full") {
                $details = true;
            } else {
                http400();
                return -1;
            }
        }
        if (isset($_GET['type'])) {
            if ($_GET['type'] == "gel-ime-gen") {
                if ($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? AND b.year=? AND b.title LIKE 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' AND b.title NOT LIKE 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " WHERE code=? and year=? and title like 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' and title not like 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' ORDER BY year asc";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('ii', $dept, $year);
                $stmt->execute();
            } elseif ($_GET["type"] == "epal-ime-gen") {
                if($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? and b.year and ((b.title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or b.title like 'ΕΠΑΛ ΝΕΟ') and b.title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " where code = ? and year = ? and ((title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or title like 'ΕΠΑΛ ΝΕΟ') and title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') order by year";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('ii', $dept, $year);
                $stmt->execute();
            } elseif ($_GET["type"] == "gel-ime-ten") {
                if($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? and b.year=? and b.title like '10\% ΓΕΛ%' " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " WHERE code=? and year=? AND title like '10\% ΓΕΛ%' ORDER BY year";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('ii', $dept, $year);
                $stmt->execute();
            } elseif ($_GET["type"] == "epal-ime-ten") {
                if ($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? and b.year=? and b.title LIKE '10\% ΕΠ%' " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " WHERE code=? and year=? AND title like '10\% ΕΠ%' ORDER BY year";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('ii', $dept, $year);
                $stmt->execute();
            }
            else {
                http400();
                return -1;
            }
        } else {
            if($details) {
                $query = "SELECT b.*, d.name, u.full_title FROM " . $this->tableName . " AS b " .
                    "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                    "WHERE b.code=? and b.year=?";
            } else {
                $query = "SELECT * FROM " . $this->tableName . " WHERE code=? and year=?";
            }
            $stmt = $this->conn->prepare($query);
            $dept = htmlspecialchars(strip_tags($dept));
            $stmt->bind_param('ii', $dept, $year);
            $stmt->execute();
        }
        return $stmt;
    }

    function readByDept($dept) {
        $details = false;
        if (isset($_GET["details"])) {
            if ($_GET["details"] == "full") {
                $details = true;
            } else {
                http400();
                return -1;
            }
        }
        if (isset($_GET["type"])) {
            if ($_GET["type"] == "gel-ime-gen") {
                if($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? AND b.title LIKE 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' AND b.title NOT LIKE 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " WHERE code=? and title like 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' and title not like 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' ORDER BY year asc";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $dept);
                $stmt->execute();
            } elseif ($_GET["type"] == "epal-ime-gen") {
                if($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? and ((b.title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or b.title like 'ΕΠΑΛ ΝΕΟ') and b.title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " where code = ? and ((title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or title like 'ΕΠΑΛ ΝΕΟ') and title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') order by year";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $dept);
                $stmt->execute();
            } elseif ($_GET["type"] == "gel-ime-ten") {
                if($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? and b.title like '10\% ΓΕΛ%' " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " WHERE code=? AND title like '10\% ΓΕΛ%' ORDER BY year";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $dept);
                $stmt->execute();
            } elseif ($_GET["type"] == "epal-ime-ten") {
                if ($details) {
                    $query = "SELECT b.*, d.name, u.full_title, u.title FROM " . $this->tableName . " AS b " .
                        "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                        "WHERE b.code=? and b.title LIKE '10\% ΕΠ%' " .
                        "ORDER BY b.year ASC";
                } else {
                    $query = "SELECT * FROM " . $this->tableName . " WHERE code=? AND title like '10\% ΕΠ%' ORDER BY year";
                }
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param('i', $dept);
                $stmt->execute();
            }
            else {
                http400();
                return -1;
            }
        } elseif (isset($_GET)) {
            http400();
            return -1;
        }
        else {
            if($details) {
                $query = "SELECT b.*, d.name, u.full_title FROM " . $this->tableName . " AS b " .
                    "LEFT JOIN dept AS d ON b.code = d.code LEFT JOIN university AS u on d.uni_id = u.id " .
                    "WHERE b.   code=?";
            } else {
                $query = "SELECT * FROM " . $this->tableName . " WHERE code=?";
            }
            $stmt = $this->conn->prepare($query);
            $dept = htmlspecialchars(strip_tags($dept));
            $stmt->bind_param('i', $dept);
            $stmt->execute();
        }
        return $stmt;
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

    function readMinYearByDept($code) {
        $query = "SELECT MIN(year) AS minYear FROM " . $this->tableName . " WHERE code=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $code);
        $stmt->execute();
        return $stmt;
    }

    function readMaxYearByDept($code) {
        $query = "SELECT MAX(year) AS maxYear FROM " . $this->tableName . " WHERE code=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $code);
        $stmt->execute();
        return $stmt;
    }

    function readSearchResultsDeptBaseAndYear($base, $dept, $year) {
        if (isset($_GET["type"])) {
            $query = "SELECT b.*, d.name, u.title, u.full_title FROM " . $this->tableName . " AS b LEFT JOIN " .
                "dept AS d ON b.code = d.code LEFT JOIN university AS u ON d.uni_id = u.id WHERE " .
                "b.vasitel < ? AND d.name like ? AND year = ? AND";
            if ($_GET["type"] == "gel-ime-gen") {
                $query .= " b.title LIKE 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' AND b.title NOT LIKE 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' " .
                    "ORDER BY code";
            } elseif ($_GET["type"] == "epal-ime-gen") {
                $query .= " ((b.title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or b.title like 'ΕΠΑΛ ΝΕΟ') and b.title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') " .
                    "ORDER BY code";
            } elseif ($_GET["type"] == "gel-ime-ten") {
                $query .= " b.title like '10\% ΓΕΛ%' " .
                    "ORDER BY code";
            } elseif ($_GET["type"] == "epal-ime-ten") {
                $query .= " b.title LIKE '10\% ΕΠ%' " .
                    "ORDER BY code";
            } else {
                http400();
                return -1;
            }
            $dept = '%'.$dept.'%';
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('isi', $base, $dept, $year);
            $stmt->execute();
            return $stmt;
        }
    }

    function readSearchResultsDeptAndBase($base, $dept) {
        if (isset($_GET["type"])) {
            $query = "SELECT b.*, d.name, u.title, u.full_title FROM " . $this->tableName . " AS b LEFT JOIN " .
                "dept AS d ON b.code = d.code LEFT JOIN university AS u ON d.uni_id = u.id WHERE " .
                "b.vasitel < ? AND d.name like ? AND";
            if ($_GET["type"] == "gel-ime-gen") {
                $query .= " b.title LIKE 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' AND b.title NOT LIKE 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' " .
                    "ORDER BY b.code,b.year";
            } elseif ($_GET["type"] == "epal-ime-gen") {
                $query .= " ((b.title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or b.title like 'ΕΠΑΛ ΝΕΟ') and b.title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') " .
                    "ORDER BY b.code,b.year";
            } elseif ($_GET["type"] == "gel-ime-ten") {
                $query .= " b.title like '10\% ΓΕΛ%' " .
                    "ORDER BY b.code,b.year";
            } elseif ($_GET["type"] == "epal-ime-ten") {
                $query .= " b.title LIKE '10\% ΕΠ%' " .
                    "ORDER BY b.code,b.year";
            } else {
                http400();
                return -1;
            }
            $dept = '%'.$dept.'%';
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('is', $base, $dept);
            $stmt->execute();
            return $stmt;
        }
    }

    function readSearchResultsBaseAndYear($base, $year) {
        if (isset($_GET["type"])) {
            $query = "SELECT b.*, d.name, u.title, u.full_title FROM " . $this->tableName . " AS b LEFT JOIN " .
                "dept AS d ON b.code = d.code LEFT JOIN university AS u ON d.uni_id = u.id WHERE " .
                "b.vasitel < ? AND year = ? AND";
            if ($_GET["type"] == "gel-ime-gen") {
                $query .= " b.title LIKE 'ΓΕΛ%ΗΜΕΡΗΣΙΑ' AND b.title NOT LIKE 'ΓΕΛ%ΠΑΛΑΙΟ%ΗΜΕΡΗΣΙΑ' " .
                    "ORDER BY b.code,b.year";
            } elseif ($_GET["type"] == "epal-ime-gen") {
                $query .= " ((b.title like 'ΕΠΑΛ% ΗΜΕΡΗΣΙΑ' or b.title like 'ΕΠΑΛ ΝΕΟ') and b.title not like 'ΕΠΑΛ% ΠΑΛΑΙΟ%') " .
                    "ORDER BY b.code,b.year";
            } elseif ($_GET["type"] == "gel-ime-ten") {
                $query .= " b.title like '10\% ΓΕΛ%' " .
                    "ORDER BY b.code,b.year";
            } elseif ($_GET["type"] == "epal-ime-ten") {
                $query .= " b.title LIKE '10\% ΕΠ%' " .
                    "ORDER BY b.code,b.year";
            } else {
                http400();
                return -1;
            }
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('is', $base, $year);
            $stmt->execute();
            return $stmt;
        }
    }
}
