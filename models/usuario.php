<?php

class Usuario {

    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    function getNombre() {
        return $this->db->real_escape_string($this->nombre);
    }
    
    function getApellidos() {
        return $this->db->real_escape_string($this->apellidos);
    }

    function getEmail() {
        return $this->db->real_escape_string($this->email);
    }

    function getPassword($isLogin = null) {
        return isset($isLogin) && !empty($isLogin) && $isLogin
            ? $this->db->real_escape_string($this->password)
            : password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    function getRol() {
        return $this->rol;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    public function save() {
        $sql = "insert into usuarios values(null, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', '{$this->getRol()}', null)";
        $save = $this->db->query($sql);

        $result  = $save ? true : false;

        return $result;
    }

    public function login() {
        // Comprobar si existe el usuario
        $sql = "select * from usuarios where email = '{$this->getEmail()}'";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1) {
            $usurio = $login->fetch_object();

            // Verificar la constraseña
            $verify = password_verify($this->getPassword(true), $usurio->password);
            return $verify ? $usurio : false;
        } else return false;
    }

}