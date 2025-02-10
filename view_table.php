<?php 
include 'db.php'; 
 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $table = $_POST['table']; 
 
    echo "<h2>Data from Table: $table</h2>"; 
 
    // Fetch table records 
    $query = "SELECT * FROM `$table`"; 
    $result = $conn->query($query); 
 
    if ($result->num_rows > 0) { 
        echo "<table border='1'><tr>"; 
 
        // Get table column names 
        while ($column = $result->fetch_field()) { 
            echo "<th>{$column->name}</th>"; 
        } 
        echo "</tr>"; 
 
        // Fetch and display table data 
        while ($row = $result->fetch_assoc()) { 
            echo "<tr>"; 
            foreach ($row as $value) { 
                echo "<td>$value</td>"; 
            } 
            echo "</tr>"; 
        } 
        echo "</table>"; 
    } else { 
        echo "No records found."; 
    } 
} 
 
// Provide an insertion form 
echo "<h2>Insert Data</h2>"; 
echo "<form method='POST' action='insert_data.php'>"; 
echo "<input type='hidden' name='table' value='$table'>"; 
echo "<label>Enter Values (comma-separated):</label>"; 
echo "<input type='text' name='values' required>"; 
echo "<button type='submit'>Insert</button>"; 
echo "</form>"; 

echo "<br><a href='index.php'><button>Back</button></a>";
?>
