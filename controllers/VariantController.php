<?php
require_once 'models/Variant.php';

class VariantController {
    
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_producte = $_POST['id_producte'];
            $nom = $_POST['nom'];
            $descripcio = $_POST['descripcio'];
            $preu = $_POST['preu'];
            $enllac_compra = $_POST['enllac_compra'];
            $nom_arxiu = '';

            if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
                $nom_arxiu = time() . '_' . basename($_FILES['imatge']['name']); 
                move_uploaded_file($_FILES['imatge']['tmp_name'], 'public/uploads/' . $nom_arxiu);
            }

            $variantModel = new Variant();
            $variantModel->crear($id_producte, $nom, $descripcio, $preu, $enllac_compra, $nom_arxiu); 
            
            header("Location: index.php?action=detall&id=" . $id_producte);
            exit();
        }
    }

    public function actualitzar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $id_producte = $_POST['id_producte'];
            $nom = $_POST['nom'];
            $descripcio = $_POST['descripcio'];
            $preu = $_POST['preu'];
            $enllac_compra = $_POST['enllac_compra'];
            
            // Si la casella està marcada, val 1. Si no, val 0.
            $comprat = isset($_POST['comprat']) ? 1 : 0;
            
            $nova_imatge = null;

            if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
                $nom_arxiu = time() . '_' . basename($_FILES['imatge']['name']); 
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], 'public/uploads/' . $nom_arxiu)) {
                    $nova_imatge = $nom_arxiu;
                }
            }

            $variantModel = new Variant();
            $variantModel->actualitzar($id, $nom, $descripcio, $preu, $enllac_compra, $comprat, $nova_imatge);
            
            header("Location: index.php?action=detall&id=" . $id_producte);
            exit();
        }
    }

    public function eliminar() {
        if (isset($_GET['id']) && isset($_GET['id_producte'])) {
            $variantModel = new Variant();
            $variantModel->eliminar($_GET['id']);
            header("Location: index.php?action=detall&id=" . $_GET['id_producte']);
            exit();
        }
    }
}
?>