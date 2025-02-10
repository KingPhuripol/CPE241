<?php
require_once 'db_config.php';
require_once 'table_operations.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DatabaseConnection();
    $tableOps = new TableOperations($db);
    $table = $_POST['table'];
    
    try {
        $columns = $tableOps->getTableColumns($table);
        $data = $tableOps->getTableData($table);
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($table); ?> Data</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .form-container { background-color: #f4f4f4; padding: 20px; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Data from Table: <?php echo htmlspecialchars($table); ?></h2>
    
    <?php if (!empty($data)): ?>
    <table>
        <tr>
            <?php foreach ($columns as $column): ?>
                <th><?php echo htmlspecialchars($column); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <?php foreach ($row as $value): ?>
                    <td><?php echo htmlspecialchars($value); ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p>No records found.</p>
    <?php endif; ?>

    <div class="form-container">
        <h3>Insert Data</h3>
        <form method="POST" action="insert_data.php">
            <input type="hidden" name="table" value="<?php echo htmlspecialchars($table); ?>">
            <label>Enter Values (comma-separated, in order):</label>
            <input type="text" name="values" required placeholder="Value1, Value2, ...">
            <button type="submit">Insert Record</button>
        </form>
    </div>

    <a href="index.php"><button>Back to Table Selection</button></a>
</body>
</html>
<?php } ?>