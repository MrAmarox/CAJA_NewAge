<?php

class usuario
{
    private $nombre;
    private $celular;
    private $correo;
    private $pass;
    private $tipo;



    public function getNombre() {
      return $this->nombre;
    }
    public function setNombre($value) {
      $this->nombre = $value;
    }

    public function getCelular() {
        return $this->celular;
      }
      public function setCelular($value) {
        $this->celular = $value;
      }

    public function getCorreo() {
      return $this->correo;
    }
    public function setCorreo($value) {
      $this->correo = $value;
    }

    public function getPass() {
      return $this->pass;
    }
    public function setPass($value) {
      $this->pass = $value;
    }

    public function getTipo() {
      return $this->tipo;
    }
    public function setTipo($value) {
      $this->tipo = $value;
    }
}
?>