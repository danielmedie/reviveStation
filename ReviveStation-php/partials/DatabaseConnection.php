<?php
class DatabaseConnection {
    private $host = 'localhost';        
    private $dbname = 'revivestation';   
    private $user = 'root';              
    private $password = 'abc123';        
    private $pdo;                       

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;  
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,                 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,            
            PDO::ATTR_EMULATE_PREPARES => false,                        
        ];

        try {
            // Skapar en ny PDO-anslutning 
            $this->pdo = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            // Mer noga felmeddlande vid SQL frågor eller anslutnig till databas
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }
}

?>
