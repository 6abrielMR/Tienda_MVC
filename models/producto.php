<?php

class Producto {

    public $id;
    public $categoria_id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $oferta;
    public $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getId() {
        return $this->id;
    }

    public function getCategoriaId() {
        return is_int($this->categoria_id) ? $this->categoria_id : "no_number";
    }

    public function getNombre() {
        return $this->db->real_escape_string($this->nombre);
    }
    
    public function getDescripcion() {
        return $this->db->real_escape_string($this->descripcion);
    }

    public function getPrecio() {
        return is_int($this->precio) ? $this->precio : "no_number";
    }

    public function getStock() {
        return is_int($this->stock) ? $this->stock : "no_number";
    }

    public function getOferta() {
        return $this->oferta;
    }

    public function getImagen() {
        return $this->db->real_escape_string($this->imagen);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function setOferta($oferta) {
        $this->oferta = $oferta;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getAll() {
        return $this->db->query("select * from productos order by id asc");
    }

    public function getAllCategory() {
        $sql = "select p.*, c.nombre as 'catnombre' from productos p 
                inner join categorias c on c.id = p.categoria_id 
                where p.categoria_id = {$this->getCategoriaId()} 
                order by id asc";
        return $this->db->query($sql);
    }

    public function save() {
        $sql = "insert into productos values(
            null,
            {$this->getCategoriaId()},
            '{$this->getNombre()}',
            '{$this->getDescripcion()}',
            {$this->getPrecio()},
            {$this->getStock()},
            null,
            curdate(),
            '{$this->getImagen()}'
        )";
        $save = $this->db->query($sql);

        return $save ? true : false;
    }

    public function update() {
        $sql = "update productos set 
            categoria_id={$this->getCategoriaId()},
            nombre='{$this->getNombre()}',
            descripcion='{$this->getDescripcion()}',
            precio={$this->getPrecio()},
            stock={$this->getStock()}";
        if ($this->getImagen() != null) $sql .= ",imagen='{$this->getImagen()}'";
        $sql .= " where id = {$this->getId()};";
        $save = $this->db->query($sql);

        return $save ? true : false;
    }

    public function delete() {
        $sql = "delete from productos where id={$this->getId()}";
        $delete = $this->db->query($sql);
        return $delete ? true : false;
    }

    public function getOne() {
        $sql = "select * from productos where id = {$this->getId()}";
        return $this->db->query($sql)->fetch_object();
    }

    public function getRandom($limit) {
        return $this->db->query("select * from productos order by rand() limit $limit");
    }

}