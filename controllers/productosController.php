<?php
require_once 'models/producto.php';

class productosController {

    public function index() {
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        // Renderizar vista
        require_once 'views/productos/destacados.php';
    }

    public function gestion() {
        Helpers::isAdmin();
        $producto = new Producto();
        $productos = $producto->getAll();
        $_SESSION[session_editar] = false;

        require_once 'views/productos/gestion.php';
    }

    public function crear() {
        Helpers::isAdmin();
        require_once 'views/productos/crear.php';
    }
    
    public function save() {
        Helpers::isAdmin();
        if (isset($_POST)) {
            $nombre = Helpers::validateFields($_POST['nombre']);
            $descripcion = Helpers::validateFields($_POST['descripcion']);
            $precio = Helpers::validateFields($_POST['precio']);
            $stock = Helpers::validateFields($_POST['stock']);
            $categoria = Helpers::validateFields($_POST['categoria']);

            if (Helpers::validateFields(
                array($nombre,$descripcion, $precio, $stock, $categoria),
                "validate")) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio((int)$precio);
                $producto->setStock((int)$stock);
                $producto->setCategoriaId((int)$categoria);

                // Guardar la imagen y los datos
                if ($_SESSION[session_editar] && isset($_GET['id'])) {
                    $producto->setId((int)$_GET['id']);
                    if (strlen($_FILES['imagen']['name']) > 0) {
                        $saveImage = true;
                        $file = $_FILES['imagen'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];

                        if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                            if (!is_dir("uploads/images")) {
                                $saveImage = mkdir("uploads/images", 0777, true);
                            }
    
                            move_uploaded_file($file["tmp_name"], "uploads/images/".$filename);
                            $producto->setImagen($filename);
    
                            if ($saveImage) {
                                $save = $producto->update();
                                if ($save){
                                    $_SESSION[session_producto] = "complete";
                                    header("Location: ".base_url."productos/gestion");
                                } else {
                                    unlink("uploads/images/".$filename);
                                    $_SESSION[session_producto] = "failed";
                                    header("Location: ".base_url."productos/crear");
                                }
                            } else {
                                $_SESSION[session_producto] = "failed_image";
                                header("Location: ".base_url."productos/crear");
                            }
                        } else {
                            $_SESSION[session_producto] = "failed_format";
                            header("Location: ".base_url."productos/crear");
                        }
                    } else {
                        $save = $producto->update();
                        if ($save){
                            $_SESSION[session_producto] = "complete";
                            header("Location: ".base_url."productos/gestion");
                        } else {
                            $_SESSION[session_producto] = "failed";
                            header("Location: ".base_url."productos/crear");
                        }
                    }
                } else {
                    if (isset($_FILES['imagen'])) {
                        $saveImage = true;
                        $file = $_FILES['imagen'];
                        $filename = $file['name'];
                        $mimetype = $file['type'];
    
                        if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                            if (!is_dir("uploads/images")) {
                                $saveImage = mkdir("uploads/images", 0777, true);
                            }
    
                            move_uploaded_file($file["tmp_name"], "uploads/images/".$filename);
                            $producto->setImagen($filename);
    
                            if ($saveImage) {
                                $save = $producto->save();
                                if ($save){
                                    $_SESSION[session_producto] = "complete";
                                    header("Location: ".base_url."productos/gestion");
                                } else {
                                    unlink("uploads/images/".$filename);
                                    $_SESSION[session_producto] = "failed";
                                    header("Location: ".base_url."productos/crear");
                                }
                            } else {
                                $_SESSION[session_producto] = "failed_image";
                                header("Location: ".base_url."productos/crear");
                            }
                        } else {
                            $_SESSION[session_producto] = "failed_format";
                            header("Location: ".base_url."productos/crear");
                        }
                    } else {
                        $_SESSION[session_producto] = "failed_null_image";
                        header("Location: ".base_url."productos/crear");
                    }
                }
            } else {
                $_SESSION[session_producto] = "failed_data";
                header("Location: ".base_url."productos/crear");
            }
        } else {
            $_SESSION[session_producto] = "failed_data";
            header("Location: ".base_url."productos/crear");
        }
    }

    public function editar() {
        Helpers::isAdmin();
        if(isset($_GET['id'])) {
            $_SESSION[session_editar] = true;
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $currentProducto = $producto->getOne();

            require_once 'views/productos/crear.php';
        } else {
            $_SESSION[session_producto] = "failed_id";
            header("Location: ".base_url."productos/gestion");
        }
    }

    public function eliminar() {
        Helpers::isAdmin();
        if(isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);

            $delete = $producto->delete();
            if ($delete) {
                $_SESSION[session_producto] = "complete";
                header("Location: ".base_url."productos/gestion");
            } else {
                $_SESSION[session_producto] = "failed";
                header("Location: ".base_url."productos/gestion");
            }
        } else {
            $_SESSION[session_producto] = "failed_data";
            header("Location: ".base_url."productos/gestion");
        }
    }

    public function ver() {
        if(isset($_GET['id'])) {
            $producto = new Producto();
            $producto->setId($_GET['id']);
            $currentProducto = $producto->getOne();

        }

        require_once 'views/productos/ver.php';
    }

}