<?php
class conexion{
    private $servername = "localhost";

    private $username = "root";

    private $password = "";

    private $dbname = "molsy";

    private $conn;


//funcion del constructor conexion
public function __construct(){
    $this->conn= new mysqli(
        $this->servername, $this->username, $this->password, $this->dbname
    );



//verificar conexion
if ($this->conn->connect_error){
    die("Error en la conexion: ".$this->conn->connect_error);
}
}

//retornar conexion
public function getConexion(){
    return $this->conn;
}

//cerrar conexion
public function CerrarConexion(){
    $this->conn->close();
}
}