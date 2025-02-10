<?php
class TableOperations {
    private $conn;

    public function __construct(DatabaseConnection $db) {
        $this->conn = $db->getConnection();
    }

    public function getTableColumns($table) {
        $query = "SHOW COLUMNS FROM `$table`";
        $result = $this->conn->query($query);
        $columns = [];
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        return $columns;
    }

    public function getTableData($table) {
        $query = "SELECT * FROM `$table`";
        $result = $this->conn->query($query);
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function insertTableData($table, $values) {
        $columns = $this->getTableColumns($table);
        
        if (count($values) !== count($columns)) {
            throw new Exception("Number of values does not match the number of columns.");
        }
        
        $values = array_map('trim', $values);
        $values = "'" . implode("', '", $values) . "'";
        $columns = implode(", ", $columns);
        $query = "INSERT INTO `$table` ($columns) VALUES ($values)";
        
        return $this->conn->query($query);
    }
}
?>