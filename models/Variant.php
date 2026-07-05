<?php
require_once 'config/database.php';

class Variant {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }


    public function crear($id_producte, $nom, $descripcio, $preu, $enllac_compra, $imatge) {
        $query = "INSERT INTO variants_producte (id_producte, nom, descripcio, preu, enllac_compra, imatge) 
                  VALUES (:id_producte, :nom, :descripcio, :preu, :enllac_compra, :imatge)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id_producte', $id_producte);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':descripcio', $descripcio);
        $stmt->bindParam(':preu', $preu);
        $stmt->bindParam(':enllac_compra', $enllac_compra);
        $stmt->bindParam(':imatge', $imatge);
        
        return $stmt->execute();
    }


    public function llegirPerProducte($id_producte) {
        $query = "SELECT * FROM variants_producte WHERE id_producte = :id_producte ORDER BY comprat ASC, preu ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id_producte', $id_producte);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualitzar($id, $nom, $descripcio, $preu, $enllac_compra, $comprat, $nova_imatge = null) {
        if ($nova_imatge) {
            $query = "UPDATE variants_producte SET nom = :nom, descripcio = :descripcio, preu = :preu, enllac_compra = :enllac_compra, comprat = :comprat, imatge = :imatge WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':imatge', $nova_imatge);
        } else {
            $query = "UPDATE variants_producte SET nom = :nom, descripcio = :descripcio, preu = :preu, enllac_compra = :enllac_compra, comprat = :comprat WHERE id = :id";
            $stmt = $this->conn->prepare($query);
        }
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':descripcio', $descripcio);
        $stmt->bindParam(':preu', $preu);
        $stmt->bindParam(':enllac_compra', $enllac_compra);
        $stmt->bindParam(':comprat', $comprat);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function eliminar($id) {
        $query = "DELETE FROM variants_producte WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>