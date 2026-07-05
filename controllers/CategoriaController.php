<?php
require_once 'models/Categoria.php';

class CategoriaController {
    
    public function index() {

        $categoriaModel = new Categoria();
        $categories = $categoriaModel->llegirTotes();
        
        require 'views/categorias/index.php';
    }

    public function nova() {
        require 'views/categorias/nova.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $nom_arxiu = ''; 

            if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
                $directori_pujades = 'public/uploads/';
                
                if (!is_dir($directori_pujades)) {
                    mkdir($directori_pujades, 0777, true);
                }

                $nom_arxiu = time() . '_' . basename($_FILES['imatge']['name']); 
                $ruta_final = $directori_pujades . $nom_arxiu;

                move_uploaded_file($_FILES['imatge']['tmp_name'], $ruta_final);
            }

            $categoriaModel = new Categoria();
            $categoriaModel->crear($nom, $nom_arxiu); 
            
            header("Location: index.php?action=categories");
            exit();
        }
    }

    public function actualitzar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $nova_imatge = null;

            if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
                $nom_arxiu = time() . '_' . basename($_FILES['imatge']['name']); 
                $ruta_final = 'public/uploads/' . $nom_arxiu;
                
                if (move_uploaded_file($_FILES['imatge']['tmp_name'], $ruta_final)) {
                    $nova_imatge = $nom_arxiu;
                }
            }

            $categoriaModel = new Categoria();
            $categoriaModel->actualitzar($id, $nom, $nova_imatge);
            
            header("Location: index.php?action=categories");
            exit();
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $categoriaModel = new Categoria();
            $categoriaModel->eliminar($_GET['id']);
        }
        header("Location: index.php?action=categories");
        exit();
    }
}
?>