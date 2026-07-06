<?php

session_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'categories';

if (!isset($_SESSION['loguejat']) && $action !== 'login' && $action !== 'fer_login') {
    header("Location: index.php?action=login");
    exit();
}

require_once 'controllers/CategoriaController.php';

$accio = isset($_GET['action']) ? $_GET['action'] : 'categories';

switch ($accio) {
    
    case 'login':
        require 'views/login.php';
        break;

    case 'fer_login':
        $password = $_POST['password'] ?? '';
        
        if ($password === '369Purple') { 
            $_SESSION['loguejat'] = true;
            header("Location: index.php");
            exit();
        } else {
            $error_login = "Contrasenya incorrecta";
            require 'views/login.php';
        }
        break;

    case 'logout':
        session_destroy();
        header("Location: index.php?action=login");
        exit();

    case 'categories':
        $controller = new CategoriaController();
        $controller->index();
        break;

    case 'productes':
        require_once 'controllers/ProducteController.php';
        $controller = new ProducteController();
        $controller->index();
        break;
    
    case 'nova_categoria':
        require_once 'controllers/CategoriaController.php';
        $controller = new CategoriaController();
        $controller->nova();
        break;
        
    case 'guardar_categoria':
        require_once 'controllers/CategoriaController.php';
        $controller = new CategoriaController();
        $controller->guardar();
        break;

    case 'actualitzar_categoria':
        require_once 'controllers/CategoriaController.php';
        $controller = new CategoriaController();
        $controller->actualitzar();
        break;
        
    case 'eliminar_categoria':
        require_once 'controllers/CategoriaController.php';
        $controller = new CategoriaController();
        $controller->eliminar();
        break;

    case 'nou_producte':
        require_once 'controllers/ProducteController.php';
        $controller = new ProducteController();
        $controller->nou();
        break;
        
    case 'guardar_producte':
        require_once 'controllers/ProducteController.php';
        $controller = new ProducteController();
        $controller->guardar();
        break;

    case 'actualitzar_producte':
        require_once 'controllers/ProducteController.php';
        $controller = new ProducteController();
        $controller->actualitzar();
        break;
        
    case 'eliminar_producte':
        require_once 'controllers/ProducteController.php';
        $controller = new ProducteController();
        $controller->eliminar();
        break;
        
    case 'detall':
        require_once 'controllers/ProducteController.php';
        $controller = new ProducteController();
        $controller->detall();
        break;
        
    case 'guardar_variant':
        require_once 'controllers/VariantController.php';
        $controller = new VariantController();
        $controller->guardar();
        break;
        
    case 'actualitzar_variant':
        require_once 'controllers/VariantController.php';
        $controller = new VariantController();
        $controller->actualitzar();
        break;
        
    case 'eliminar_variant':
        require_once 'controllers/VariantController.php';
        $controller = new VariantController();
        $controller->eliminar();
        break;


    default:
        echo "<h1>Error 404</h1><p>La pàgina no existeix.</p>";
        break;
}

?>