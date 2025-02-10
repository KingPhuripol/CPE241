<?php
require_once 'db_config.php';
require_once 'table_operations.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $table = $_POST['table'];
    $values = explode(",", $_POST['values']);
    
    $db = new DatabaseConnection();
    $tableOps = new TableOperations($db);
    
    try {
        $result = $tableOps->insertTableData($table, $values);
        $message = $result ? "Record inserted successfully!" : "Error inserting record.";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Result</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .message { padding: 20px; background-color: #f4f4f4; display: inline-block; }
    </style>
</head>
<body>
    <div class="message">
        <h2><?php echo $message; ?></h2>
        <a href="index.php"><button>Back to Table Selection</button></a>
    </div>
</body>
</html>
<?php } ?>