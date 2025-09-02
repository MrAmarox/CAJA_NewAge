<?php

class usuario
{
  private $cedula;
    private $nombre;
    private $telefono;
    private $correo;
    private $contrasena;
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

    public function getContrasena() {
      return $this->Contrasena;
    }
    public function setContrasena($Contrasena) {
      $this->contrasena = $Contrasena;
    }

    public function getTipo() {
      return $this->tipo;
    }
    public function setTipo($value) {
      $this->tipo = $value;
    }

    //Metodo login
public function Login(){
  include_once "../Persistencia/usuarioBD.php";
  $uBd= new UsuarioBD();
  return $uBd->Login($this->correo, $this->contrasena);
}

public function RegistrarUsuario(){
  include_once "../Persistencia/usuarioBD.php";
  $uBd = new UsuarioBD();
 return $uBd->RegistrarUsuario($this->cedula, $this->nombre, $this->telefono, $this->correo, $this->contrasena, $this->tipo);
}

    public function __construct($pass, $naem, $corr, $cel){
      $this->pass=$pass;
      $this->nombre=$naem;
      $this->correo=$corr;
      $this->celular=$cel;
      $this->tipo=1;
    }
}
?>