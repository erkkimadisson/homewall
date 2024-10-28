<?php
use Dotenv\Dotenv;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . "/..");
$dotenv->load();

class Database
{

    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USERNAME'];
        $this->password = $_ENV['DB_PASSWORD'];
    }
    public function getConnection()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";", $this->username, $this->password);
            #$this->conn->exec("CREATE DATABASE IF NOT EXISTS " . $this->db_name);
            $this->conn->exec("use " . $this->db_name);
            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Load and execute SQL files for tables and views
            $this->createTablesAndViews();

        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    private function createTablesAndViews()
    {
        $sqlFiles = glob(__DIR__ . '/models/*.sql');
        foreach ($sqlFiles as $file) {
            $sql = file_get_contents($file);
            $this->conn->exec($sql);
        }
    }
}

?>