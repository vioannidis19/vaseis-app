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
                $query = "SELECT d.*, u.title, u.full_title, u.logoURL AS uni_logo FROM " . $this->tableName .
                    " AS d LEFT JOIN university AS u ON d.uni_id = u.id ORDER BY uni_id";
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
