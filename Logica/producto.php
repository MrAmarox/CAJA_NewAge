<?php

class Producto {
    private $IDProducto;
    private $nombre;
    private $precio;
    private $color;
    private $talle;
    private $foto;
    private $subcatID;
    private $estado;

    public function getIDProducto(){
        return $this->IDProducto;
    }

    public function setIDProducto($IDProducto){
        $this->IDProducto=$IDProducto;
    }

    // Metodos Nombre
    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    //Metodos precio
    public function getPrecio(){
        return $this->precio;
    }

    public function setPrecio($precio){
        $this->precio=$precio;
    }

    //Metodos color
    public function getColor(){
        return $this->color;
    }

    public function setColor($color){
        $this->color=$color;
    }

    //Metodos talle
    public function getTalle(){
        return $this->talle;
    }

    public function setTalle($talle){
        $this->talle=$talle;
    }

    //metodos foto
    public function getFoto(){
        return $this->foto;
    }
    public function setFoto($foto){
        $this->foto=$foto;
    }
    public function getSubcatID(){
        return $this->subcatID;
    }
    public function setSubcatID($value){
        $this->subcatID = $value;
    }
    public function getEstado(){
        return $this->estado;
    }
    public function setEstado($value){
        $this->estado = $value;
    }

    public function __construct($name, $precio, $color, $talle, $foto, $subcatID, $estado) {
        $this->nombre=$name;
        $this->precio=$precio;
        $this->color=$color;
        $this->talle=$talle;
        $this->foto=$foto;
        $this->subcatID=$subcatID;
        $this->estado=$estado;
    }

    public function AddProducto(){
        include_once "../Persistencia/productoBD.php";
        $pBD = new productoBD();
        $pBD->AddProducto($this->nombre, $this->precio, $this->color, $this->talle, $this->foto, $this->estado, $this->subcatID);
    }

    public static function listarProductos($wpar, $param){
        include_once __DIR__."/../Persistencia/productoBD.php";
        $pBD = new productoBD();
        return $pBD->listarProductos($wpar, $param);
    }



}