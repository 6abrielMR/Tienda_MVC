<?php
require_once 'models/pedido.php';

class pedidoController {

    public function hacer() {
        require_once 'views/pedido/hacer.php';
    }

    public function add() {
        if (isset($_SESSION[identity_login])) {
            $usuario_id = $_SESSION[identity_login]->id;
            $stats = Helpers::statsCarrito();
            $coste = $stats['total'];
            $provincia = Helpers::validateFields($_POST['provincia']);
            $localidad = Helpers::validateFields($_POST['localidad']);
            $direccion = Helpers::validateFields($_POST['direccion']);

            if (Helpers::validateFields(array($provincia, $localidad, $direccion), "validate")) {
                // Guardar datos en bd
                $pedido = new Pedido();
                $pedido->setUsuarioId((int)$usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste((int)$coste);
                $pedido->setEstado("confirm");

                $save = $pedido->save();

                // Guardar linea pedido
                $save_linea = $pedido->saveLinea();

                if ($save && $save_linea) {
                    $_SESSION[session_pedido] = "complete";
                    header("Location: ".base_url."pedido/confirmado");
                } else {
                    $_SESSION[session_pedido] = "failed";
                    header("Location: ".base_url."pedido/confirmado");
                }
            } else {
                $_SESSION[session_pedido] = "failed_data";
                header("Location: ".base_url."pedido/confirmado");
            }
        } else {
            $_SESSION[session_pedido] = "failed_identity";
            header("Location: ".base_url."pedido/confirmado");
        }
    }

    public function confirmado() {
        if (isset($_SESSION[identity_login])) {
            $identity = $_SESSION[identity_login];
            $pedido = new Pedido();
            $pedido->setUsuarioId((int)$identity->id);
            
            $pedido = $pedido->getOneByUser();
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }

        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos() {
        Helpers::isIdentity();
        $usuario_id = $_SESSION[identity_login]->id;
        $pedido = new Pedido();

        // Sacar los pedidos del usuario
        $pedido->setUsuarioId((int)$usuario_id);
        $pedidos = $pedido->getAllByUser();
        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle() {
        Helpers::isIdentity();
        if(isset($_GET['id'])) {
            // Sacaar el pedido
            $pedido = new Pedido();
            $pedido->setId((int)$_GET['id']);
            $pedido = $pedido->getOne();
            
            // Sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($_GET['id']);
        } else {
            $_SESSION[session_pedido] = "failed_pedido_id";
            header("Location: ".base_url."pedido/mis_pedidos");
        }
        require_once 'views/pedido/detalle.php';
    }

    public function gestion() {
        Helpers::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado() {
        Helpers::isAdmin();
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            // Update del pedido
            $pedido = new Pedido();
            $pedido->setId((int)$_POST['pedido_id']);
            $pedido->setEstado($_POST['estado']);
            $pedido->updateOne();

            header("Location: ".base_url."pedido/detalle&id=".$_POST['pedido_id']);
        } else {
            $_SESSION[session_pedido] = "failed_pedido_id";
            header("Location: ".base_url);
        }
    }

}