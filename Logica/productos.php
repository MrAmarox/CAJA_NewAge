<?php

class Producto {

    private $IDProducto;

    private $nombre;

    private $precio;

    private $color;

    private $talle;

    private $foto;



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


public function AñadirProducto()
{
    include_once __DIR__."/../Persistencia/productoBD.php";
    $productoBD = new productoBD();
    $productoBD->AñadirProducto($this->nombre, $this->precio, $this->color, $this->talle, $this->foto);
}

public function listarProductos()
{
    include_once __DIR__."/../Persistencia/productoBD.php";
    $productoBD = new productoBD();
    return $productoBD->listarProductos();
}

}