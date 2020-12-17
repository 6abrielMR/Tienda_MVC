<?php

class Producto {

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

    public function getCategoriaId() {
        return $this->categoria_id;
    }

    public function getNombre() {
        return $this->nombre;
    }
    
    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getStock() {
        return $this->stock;
    }

    public function getOferta() {
        return $this->oferta;
    }

    public function getImagen() {
        return $this->imagen;
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

}