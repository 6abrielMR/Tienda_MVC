<?php

class Categoria {

    public $id;
    public $nombre;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getId() {
        return is_int($this->id) ? $this->id : "no_number";
    }

    public function getNombre() {
        return $this->db->real_escape_string($this->nombre);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getAll() {
        return $this->db->query("select * from categorias order by id asc");
    }

    public function save() {
        $sql = "insert into categorias values(null, '{$this->getNombre()}')";
        $save = $this->db->query($sql);

        $result  = $save ? true : false;

        return $result;
    }

    public function getOne() {
        return $this->db->query("select * from categorias where id={$this->getId()}")->fetch_object();
    }

}