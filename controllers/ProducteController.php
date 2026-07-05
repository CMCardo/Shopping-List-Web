<?php
require_once 'models/Producte.php';
require_once 'models/Categoria.php'; 

class ProducteController {
    
    public function index() {

        if (isset($_GET['id_categoria']) && !empty($_GET['id_categoria'])) {
            $id_categoria = $_GET['id_categoria'];
            
            $categoriaModel = new Categoria();
            $categoria_actual = $categoriaModel->llegirPerId($id_categoria);
            
            if (!$categoria_actual) {
                header("Location: index.php?action=categories");
                exit();
            }
            
            $producteModel = new Producte();
            $productes = $producteModel->llegirPerCategoria($id_categoria);
            
            foreach ($productes as $key => $producte) {
                $productes[$key]['rang_preus'] = $producteModel->obtenirRangPreus($producte['id']);
            }
            
            require 'views/productes/index.php';
        } else {

            header("Location: index.php?action=categories");
            exit();
        }
    }


    public function nou() {
        if (isset($_GET['id_categoria'])) {
            $id_categoria = $_GET['id_categoria'];
            require 'views/productes/nou.php';
        } else {
            header("Location: index.php?action=categories");
            exit();
        }
    }


    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_categoria = $_POST['id_categoria'];
            $nom = $_POST['nom'];
            
            $descripcio = ''; 
            $preu = 0; 
            $enllac_compra = ''; 
            $nom_arxiu = ''; 

            if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
                $directori_pujades = 'public/uploads/';
                if (!is_dir($directori_pujades)) mkdir($directori_pujades, 0777, true);
                
                $nom_arxiu = time() . '_' . basename($_FILES['imatge']['name']); 
                $ruta_final = $directori_pujades . $nom_arxiu;
                move_uploaded_file($_FILES['imatge']['tmp_name'], $ruta_final);
            }

            $producteModel = new Producte();
            $producteModel->crear($id_categoria, $nom, $descripcio, $preu, $enllac_compra, $nom_arxiu); 
            
            header("Location: index.php?action=productes&id_categoria=" . $id_categoria);
            exit();
        }
    }


    public function actualitzar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $id_categoria = $_POST['id_categoria']; 
            $nom = $_POST['nom'];
            
            $descripcio = ''; 
            $preu = 0; 
            $enllac_compra = ''; 
            $nova_imatge = null;

            if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
                $nom_arxiu = time() . '_' . basename($_FILES['imatge']['name']); 
                $ruta_final = 'public/uploads/' . $nom_arxiu;
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $ruta_final)) {
                    $nova_imatge = $nom_arxiu;
                }
            }

            $producteModel = new Producte();
            $producteModel->actualitzar($id, $nom, $descripcio, $preu, $enllac_compra, $nova_imatge);
            
            header("Location: index.php?action=productes&id_categoria=" . $id_categoria);
            exit();
        }
    }

    public function eliminar() {
        if (isset($_GET['id']) && isset($_GET['id_categoria'])) {
            $producteModel = new Producte();
            $producteModel->eliminar($_GET['id']);
            
            header("Location: index.php?action=productes&id_categoria=" . $_GET['id_categoria']);
            exit();
        }
    }

    public function detall() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id_producte = $_GET['id'];
            
            $producteModel = new Producte();
            $producte_actual = $producteModel->llegirPerId($id_producte);
            
            if (!$producte_actual) {
                header("Location: index.php?action=categories");
                exit();
            }

            require_once 'models/Variant.php';
            $variantModel = new Variant();
            $variants = $variantModel->llegirPerProducte($id_producte);
            
            require 'views/productes/detall.php';
        } else {
            header("Location: index.php?action=categories");
            exit();
        }
    }
}
?>