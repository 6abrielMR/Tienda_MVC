<?php

class Pedido {

    private $id;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $coste;
    private $estado;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getId() {
        return is_int($this->id) ? $this->id : "no_number";
    }

    public function getUsuarioId() {
        return is_int($this->usuario_id) ? $this->usuario_id : "no_number";
    }

    public function getProvincia() {
        return $this->db->real_escape_string($this->provincia);
    }

    public function getLocalidad() {
        return $this->db->real_escape_string($this->localidad);
    }

    public function getDireccion() {
        return $this->db->real_escape_string($this->direccion);
    }

    public function getCoste() {
        return is_int($this->coste) ? $this->coste : "no_number";
    }

    public function getEstado() {
        return $this->db->real_escape_string($this->estado);
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
    
    public function setProvincia($provincia) {
        $this->provincia = $provincia;
    }

    public function setLocalidad($localidad) {
        $this->localidad = $localidad;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setCoste($coste) {
        $this->coste = $coste;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getAll() {
        return $this->db->query("select * from pedidos order by id asc");
    }

    public function getOne() {
        return $this->db->query("select * from pedidos where id = {$this->getId()}")->fetch_object();
    }

    public function getOneByUser() {
        $sql = "select p.id, p.coste from pedidos p 
                where p.usuario_id = {$this->getUsuarioId()} order by id desc limit 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser() {
        $sql = "select p.* from pedidos p 
                where p.usuario_id = {$this->getUsuarioId()} order by id desc";
        return $this->db->query($sql);
    }

    public function getProductosByPedido($id) {
        $sql = "select pr.*, lp.unidades from productos pr 
                inner join lineas_pedidos lp on pr.id = lp.producto_id 
                where lp.pedido_id=$id";
        return $this->db->query($sql);
    }

    public function save() {
        $sql = "insert into pedidos values(
            null,
            {$this->getUsuarioId()},
            '{$this->getProvincia()}',
            '{$this->getLocalidad()}',
            '{$this->getDireccion()}',
            {$this->getCoste()},
            '{$this->getEstado()}',
            curdate(),
            curtime()
        );";
        $save = $this->db->query($sql);

        return $save ? true : false;
    }

    public function saveLinea() {
        $sql = "select last_insert_id() as 'pedido'";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;
        
        foreach ($_SESSION[session_carrito] as $elemento) {
            $producto = $elemento['producto'];
            $insert = "insert into lineas_pedidos values(
                null,
                $pedido_id,
                {$producto->id},
                {$elemento['unidades']}
            )";
            $save = $this->db->query($insert);
        }

        return $save ? true : false;
    }

    public function updateOne() {
        $sql = "update pedidos set estado = '{$this->getEstado()}' where id = {$this->getId()}";
        $save = $this->db->query($sql);
        return $save ? true : false;
    }

}