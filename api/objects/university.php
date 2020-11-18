<?php
Class University {

    private $conn;
    private $tableName = "university";

    public $id;
    public $title;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT * FROM " . $this->tableName;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    function readOne() {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $this->id);

        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if(!$row) {
            $this->title = null;
        }else{
            $this->title = $row["title"];
        }
    }

    function search($keywords) {
        $query = "SELECT * FROM " . $this->tableName . " WHERE id LIKE ? OR title LIKE ?";
        $stmt = $this->conn->prepare($query);

        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        $stmt->bind_param('ss', $keywords, $keywords);

        $stmt->execute();
        return $stmt;
    }
}
