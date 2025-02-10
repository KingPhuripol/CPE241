<?php 
include 'db.php'; 
// Fetch all table names 
$tables = []; 
$query = "SHOW TABLES"; 
$result = $conn->query($query); 
while ($row = $result->fetch_array()) { 
    $tables[] = $row[0]; 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Select Table</title> 
</head> 
<body> 
    <h2>Select a Table</h2> 
    <form method="POST" action="view_table.php"> 
        <label for="table">Choose a table:</label> 
        <select name="table" required> 
            <?php foreach ($tables as $table): ?> 
                <option value="<?php echo $table; ?>"><?php echo $table; ?></option> 
            <?php endforeach; ?> 
        </select> 
        <button type="submit">View Table</button> 
    </form> 
</body> 
</html>
