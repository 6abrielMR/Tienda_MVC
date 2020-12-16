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
        return $this->nombre;
    }
    
    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
    }

    function setPassword($password) {
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
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

}