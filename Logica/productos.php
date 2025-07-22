<?php

class Producto {
    private $nombre;

    private $precio;

    private $color;

    private $talle;

    private $foto;

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

}