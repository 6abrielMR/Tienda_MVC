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
        header("Location: ".base_url."categoria/crear");
    }

    public function login() {
        if (isset($_POST)) {
            // Identificar al usuario
            // Consulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();
            
            if ($identity && is_object($identity)) {
                $_SESSION[identity_login] = $identity;
                if ($identity->rol == "admin") {
                    $_SESSION[admin_login] = true;
                }
            } else $_SESSION[error_login] = "Identificacion fallida";
        }

        header("Location: ".base_url);
    }

    public function logout() {
        if (isset($_SESSION[identity_login])) Helpers::deleteCurrentSession(identity_login);
        if (isset($_SESSION[error_login])) Helpers::deleteCurrentSession(error_login);
        if (isset($_SESSION[admin_login])) Helpers::deleteCurrentSession(admin_login);
        header("Location: ".base_url);
    }

}