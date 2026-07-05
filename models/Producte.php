<?php
require_once 'config/database.php';

class Producte {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function llegirPerCategoria($id_categoria) {
        $query = "SELECT * FROM productes WHERE id_categoria = :id_categoria ORDER BY creado_en DESC";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($id_categoria, $nom, $descripcio, $preu, $enllac_compra, $imatge_nom) {
        $query = "INSERT INTO productes (id_categoria, nom, descripcio, preu, enllac_compra, imatge) 
                  VALUES (:id_categoria, :nom, :descripcio, :preu, :enllac_compra, :imatge)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id_categoria', $id_categoria);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':descripcio', $descripcio);
        $stmt->bindParam(':preu', $preu);
        $stmt->bindParam(':enllac_compra', $enllac_compra);
        $stmt->bindParam(':imatge', $imatge_nom);
        
        return $stmt->execute();
    }

    public function actualitzar($id, $nom, $descripcio, $preu, $enllac_compra, $nova_imatge = null) {
        if ($nova_imatge) {
            $query = "UPDATE productes SET nom = :nom, descripcio = :descripcio, preu = :preu, enllac_compra = :enllac_compra, imatge = :imatge WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':imatge', $nova_imatge);
        } else {
            $query = "UPDATE productes SET nom = :nom, descripcio = :descripcio, preu = :preu, enllac_compra = :enllac_compra WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }
        
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':descripcio', $descripcio);
        $stmt->bindParam(':preu', $preu);
        $stmt->bindParam(':enllac_compra', $enllac_compra);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM productes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function obtenirRangPreus($id_producte) {
        $query = "SELECT MIN(preu) as min_preu, MAX(preu) as max_preu FROM variants_producte WHERE id_producte = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id_producte);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row['min_preu'] === null) {
            return "Sense models";
        } 
        elseif ($row['min_preu'] == $row['max_preu']) {
            return $row['min_preu'] . " €";
        } 
        else {
            return $row['min_preu'] . " € - " . $row['max_preu'] . " €";
        }
    }


    public function llegirPerId($id) {
        $query = "SELECT * FROM productes WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>