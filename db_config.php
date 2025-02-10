<?php
class DatabaseConnection {
    private $host = "localhost";
    private $user = "root";
    private $password = ""; // Usually empty in XAMPP
    private $dbname = "myapp";

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function getTables() {
        $tables = [];
        $query = "SHOW TABLES";
        $result = $this->conn->query($query);
        while ($row = $result->fetch_array()) {
            $tables[] = $row[0];
        }
        return $tables;
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>