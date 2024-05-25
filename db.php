<?php
class DB {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $dsn = 'mysql:host=localhost;dbname=petition;charset=utf8';
        try {
            $this->conn = new PDO($dsn, 'root', ''); // Assuming the password is empty
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new DB();
        }
        return self::$instance->conn;
    }
}
?>
