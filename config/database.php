<?php

class Database {

    private $host = "localhost";
    private $db_name = "llista_compres";
    private $username = "root";
    private $password = ""; 
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Error de connexió a la Base de Dades: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>