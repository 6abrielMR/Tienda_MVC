<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController {
    
    public function index() {
        Helpers::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function crear() {
        Helpers::isAdmin();
        require_once 'views/categoria/crear.php';
    }

    public function save() {
        Helpers::isAdmin();

        if (isset($_POST)) {
            $nombre = Helpers::validateFields($_POST['nombre']);

            if (Helpers::validateFields(array($nombre), "validate")) {
                // Guardar la categoria en la base de datos
                $categoria = new Categoria();
                $categoria->setNombre($_POST['nombre']);
                $save = $categoria->save();
                if ($save) {
                    $_SESSION[session_categoria] = "complete";
                    header("Location: ".base_url."categoria/index");
                } else {
                    $_SESSION[session_categoria] = "failed";
                    header("Location: ".base_url."categoria/crear");
                }
            } else {
                $_SESSION[session_categoria] = "failed_data";
                header("Location: ".base_url."categoria/crear");
            }
        } else {
            $_SESSION[session_categoria] = "failed";
            header("Location: ".base_url."categoria/crear");
        }
    }

    public function ver() {
        if (isset($_GET['id'])) {

            // Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId((int)$_GET['id']);
            $currentCategoria = $categoria->getOne();

            // Conseguir productos
            $producto = new Producto();
            $producto->setCategoriaId((int)$_GET['id']);
            $productos = $producto->getAllCategory();
        }
        require_once 'views/categoria/ver.php';
    }

}