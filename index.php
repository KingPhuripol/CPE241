<?php
require_once 'db_config.php';

$db = new DatabaseConnection();
$tables = $db->getTables();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Database Table Viewer</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 20px auto; }
        .container { background-color: #f4f4f4; padding: 20px; border-radius: 5px; }
        select, button { margin: 10px 0; padding: 8px; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Select a Table</h2>
        <form method="POST" action="view_table.php">
            <select name="table" required>
                <?php foreach ($tables as $table): ?>
                    <option value="<?php echo htmlspecialchars($table); ?>">
                        <?php echo htmlspecialchars($table); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">View Table</button>
        </form>
    </div>
</body>
</html>