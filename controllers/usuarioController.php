<?php

require_once 'models/usuario.php';

class usuarioController {

    public function index(){
        echo "Controlador usuarios, Acción index";
    }

    public function registro() {
        require_once('views/usuario/registro.php');
    }

    public function save() {
        if (isset($_POST)) {
            $nombre = Helpers::validateFields($_POST['nombre']);
            $apellidos = Helpers::validateFields($_POST['apellidos']);
            $email = Helpers::validateFields($_POST['email']);
            $password = Helpers::validateFields($_POST['password']);

            if(Helpers::validateFields(array($nombre, $apellidos, $email, $password), "validate")){
                $usuario = new Usuario();
                $usuario->setNombre($_POST['nombre']);
                $usuario->setApellidos($_POST['apellidos']);
                $usuario->setEmail($_POST['email']);
                $usuario->setPassword($_POST['password']);
                $usuario->setRol("user");
                $save = $usuario->save();
                $save ? $_SESSION[session_register] = "complete" : $_SESSION[session_register] = "failed";
            } else $_SESSION[session_register] = "failed_data";
        } else $_SESSION[session_register] = "failed";
        header("Location: ".base_url."usuario/registro");
    }

}