<?php
require_once 'config/database.php';

class Categoria {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear($nom, $imatge_nom) {
        $query = "INSERT INTO categories (nom, imatge) VALUES (:nom, :imatge)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':imatge', $imatge_nom);
        return $stmt->execute();
    }

    public function llegirTotes() {
        $query = "SELECT * FROM categories ORDER BY creado_en DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualitzar($id, $nom, $nova_imatge = null) {
        if ($nova_imatge) {
            $query = "UPDATE categories SET nom = :nom, imatge = :imatge WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':imatge', $nova_imatge);
        } else {
            $query = "UPDATE categories SET nom = :nom WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function llegirPerId($id) {
        $query = "SELECT * FROM categories WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>