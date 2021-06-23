<?php

class Department {
    private $conn;
    private $tableName = "dept";

    public $code;
    public $name;
    public $uniId;
    public $uniName;
    public $isActive;
    public $websiteURL;
    public $logoURL;
    public $phone;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        if (isset($_GET["details"])) {
            if ($_GET["details"] == "full") {
                if (isset($_GET["fields"])) {
                    if ($_GET["fields"] == "true") {
                        $query = "SELECT DISTINCT d.*, u.title, u.full_title, u.logoURL AS uni_logo, b.field FROM " . $this->tableName .
                        " AS d LEFT JOIN university AS u ON d.uni_id = u.id LEFT JOIN base AS b ON d.code = b.code
                        WHERE b.year = (SELECT MAX(year) FROM base) AND b.field <> '' ORDER BY uni_id";
                    } else {
                        http400();
                        return -1;
                    }
                } else {
                    $query = "SELECT d.*, u.title, u.full_title, u.logoURL AS uni_logo FROM " . $this->tableName .
                        " AS d LEFT JOIN university AS u ON d.uni_id = u.id ORDER BY uni_id";
                }
            } else {
                http400();
                return -1;
            }
        } else {
            $query = "SELECT * FROM " . $this->tableName . " ORDER BY uni_id";
        }
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readByCode($dept) {
        if (isset($_GET["details"])) {
            if ($_GET["details"] == "full") {
                if (isset($_GET["fields"])) {
                    if ($_GET["fields"] == "true") {
                        $query = "SELECT DISTINCT d.*, u.title, u.full_title, u.logoURL AS uni_logo, b.field FROM " . $this->tableName .
                            " AS d LEFT JOIN university AS u ON d.uni_id = u.id LEFT JOIN base AS b ON d.code = b.code
                        WHERE b.year = (SELECT MAX(year) FROM base) AND b.field <> '' AND d.code=? ORDER BY uni_id";
                    } else {
                        http400();
                        return -1;
                    }
                } else {
                    $query = "SELECT d.*, u.title, u.full_title, u.logoURL AS uni_logo FROM " . $this->tableName .
                        " AS d LEFT JOIN university AS u ON d.uni_id = u.id WHERE code=?";
                }
            } else {
                http400();
                return -1;
            }
        } else {
            $query = "SELECT * FROM " . $this->tableName . " WHERE code=?";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $dept);
        $stmt->execute();
        return $stmt;
    }

    function readByUniId($uniId) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE uni_id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $uniId);
        $stmt->execute();
        return $stmt;
    }
}
