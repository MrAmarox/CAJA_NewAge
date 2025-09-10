<?php

class usuario{
  private $cedula;
  private $nombre;
  private $telefono;
  private $correo;
  private $pass;
  private $tipo;
  //CEDULA
  public function getCedula(){
    return $this->cedula;
  }
  public function setCedula($cedula){
    $this->cedula=$cedula;
  }


  public function getNombre() {
    return $this->nombre;
  }
  public function setNombre($value) {
    $this->nombre = $value;
  }

  public function getTelefono() {
      return $this->telefono;
    }
    public function setTelefono($value) {
      $this->telefono = $value;
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

  //Metodo login
  public static function Login($corr, $pas){
    include_once "../Persistencia/usuarioBD.php";
    $uBd= new UsuarioBD();
    return $uBd->Login($corr, $pas);
  }

  public function RegistrarUsuario($pas){
    if($this->tipo==null){
      $this->tipo= 1;
    }
    include_once "../Persistencia/usuarioBD.php";
    $uBd = new UsuarioBD();
    return $uBd->RegistrarUsuario($this->cedula, $this->nombre, $this->telefono, $this->correo, $pas, $this->tipo);
  }
  public static function bringUsrs(){
    include_once '../Persistencia/usuarioBD.php';
    $uBD= new UsuarioBD();
    return $uBD->bringUsrs();
  }
  public function __construct($ci, $naem, $corr, $cel){
    $this->cedula = $ci;
    $this->nombre=$naem;
    $this->correo=$corr;
    $this->telefono=$cel;
    $this->tipo=1;
  }
}
?>