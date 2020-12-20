<?php
require_once 'models/producto.php';

class carritoController {

    public function index() {
        $carrito = isset($_SESSION[session_carrito]) ? $_SESSION[session_carrito] : null;
        require_once 'views/carrito/index.php';
    }

    public function add() {
        if (isset($_GET['id'])) $producto_id = $_GET['id'];
        else header("Location: ".base_url);

        if (isset($_SESSION[session_carrito])) {
            $counter = 0;
            foreach ($_SESSION[session_carrito] as $index => $element) {
                if ($element['id_producto'] == $producto_id) {
                    $_SESSION[session_carrito][$index]['unidades']++;
                    $counter++;
                }
            }
        }

        if (!isset($counter) || $counter == 0) {
            // Conseguir producto
            $producto = new Producto();
            $producto->setId((int)$producto_id);
            $producto = $producto->getOne();

            if (is_object($producto)) {
                $_SESSION[session_carrito][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }

        header("Location: ".base_url."carrito/index");
    }

    public function remove() {
        if (isset($_GET['index'])) {
            unset($_SESSION[session_carrito][$_GET['index']]);
            header("Location: ".base_url."carrito/index");
        }
    }

    public function delete_all() {
        Helpers::deleteCurrentSession(session_carrito);
        header("Location: ".base_url."carrito/index");
    }

    public function up() {
        if (isset($_GET['index'])) $_SESSION[session_carrito][$_GET['index']]['unidades']++;
        header("Location: ".base_url."carrito/index");
    }

    public function down() {
        if (isset($_GET['index'])) $_SESSION[session_carrito][$_GET['index']]['unidades']--;
        if ($_SESSION[session_carrito][$_GET['index']]['unidades'] == 0) unset($_SESSION[session_carrito][$_GET['index']]);
        header("Location: ".base_url."carrito/index");
    }

}