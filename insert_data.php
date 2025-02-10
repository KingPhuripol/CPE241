<?php 
include 'db.php'; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $table = $_POST['table']; 
    $values = explode(",", $_POST['values']); 
 
    // Fetch column names 
    $query = "SHOW COLUMNS FROM `$table`"; 
    $result = $conn->query($query); 
    $columns = []; 
 
    while ($row = $result->fetch_assoc()) { 
        $columns[] = $row['Field']; 
    } 
 
    // Ensure number of values matches number of columns 
    if (count($values) !== count($columns)) { 
        die("Error: Number of values does not match the number of columns."); 
    } 
 
    // Construct query 
    $values = array_map('trim', $values); 
    $values = "'" . implode("', '", $values) . "'"; 
    $columns = implode(", ", $columns); 
    $query = "INSERT INTO `$table` ($columns) VALUES ($values)"; 
 
    if ($conn->query($query)) { 
        echo "Record inserted successfully!"; 
    } else { 
        echo "Error inserting record: " . $conn->error; 
    } 
} 
?>
