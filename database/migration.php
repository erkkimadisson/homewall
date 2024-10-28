<?php

require_once 'Database.php';

class Migration
{
    // ... (rest of the class code) ...

    public function runMigrations()
    {
        $database = new Database();
        $conn = $database->getConnection();
        $modelFiles = glob(__DIR__ . '/models/*.sql');

        try {
            foreach ($modelFiles as $file) {
                $tableName = pathinfo($file, PATHINFO_FILENAME); // Extract table name from filename
                $conn->exec("DROP TABLE IF EXISTS {$tableName}_backup");
                // Backup the table
                $conn->exec("CREATE TABLE {$tableName}_backup LIKE {$tableName}");
                $conn->exec("INSERT INTO {$tableName}_backup SELECT * FROM {$tableName}");

                // Delete the original table
                $conn->exec("DROP TABLE {$tableName}");

                // Recreate the table with the updated schema
                $sql = file_get_contents($file);
                $conn->exec($sql);
                $conn->exec("INSERT INTO {$tableName} SELECT * FROM {$tableName}_backup");

                echo "Updated database from model: " . basename($file) . "\n";
            }
        } catch (PDOException $e) {
            echo "Error updating database: " . $e->getMessage() . "\n";
        }
    }
}

$migration = new Migration();
$migration->runMigrations();

?>