<?php

class conexion { 
    private $nombreServidor = "localhost";
    private $nombreUsuario = "root";
    private $pass = "";

    private $bd = "pruebaf";
    private $conexion;

    public function conectar() {
        $this->conexion = new mysqli($this->nombreServidor, $this->nombreUsuario, $this->pass, $this->bd);
        if ($this->conexion->connect_error) {
            die("Error al conectarse" . $this->conexion->connect_error);
        } else{
            return $this->conexion;
        }
    }
        public function Desconectar(){
            $this->conexion->close();
        }


    }   
?>