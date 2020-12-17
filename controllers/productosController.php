<?php
require_once 'models/producto.php';

class productosController {

    public function index() {        
        // Renderizar vista
        require_once 'views/productos/destacados.php';
    }

    public function gestion() {
        Helpers::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/productos/gestion.php';
    }

    public function crear() {
        echo "<h1>Crear producto</h1>";
    }
    
}