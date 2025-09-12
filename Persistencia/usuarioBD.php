<?php
include_once "conexion.php";
include_once "../Logica/usuario.php";

class usuarioBD extends conexion {

    public function Login ($correo, $contrasena){

        $con = $this->getConexion();
        $sql = "select * from usuario where Correo=? and pass=?";
        $stmt = $con->prepare($sql);

        $stmt->bind_param("ss", $correo, $contrasena);
        $stmt->execute();

        $resultado = $stmt->get_result();

        
        if ($resultado->num_rows > 0){
            while ($fila = $resultado->fetch_assoc()){
                $usuario = new usuario($fila['Cedula'], $fila['Nombre'], $fila['Correo'], $fila['Telefono']);
                $usuario->setTipo($fila['Tipo']);
            }
            return $usuario;
        } else {
            return null;
        }
    }

    public function bringUsrs(){
        $con = $this->getConexion();
        $sql = 'select * from usuario';
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $usrs=[];
            while ($fila = $res->fetch_assoc()){
                $usuario = new usuario($fila['Cedula'], $fila['Nombre'], $fila['Correo'], $fila['Telefono']);
                $usuario->setTipo($fila['Tipo']);
                $usrs[]=$usuario;
            }
            return $usrs;
        } else {
            return null;
        }
    }
    public function modUsr($usr){
        $nom=$usr->getNombre();
        $corr= $usr->getCorreo();
        $tel=$usr->getTelefono();
        $typ=$usr->getTipo();
        $ci=$usr->getCedula();
        $con = $this->getConexion();
        $sql = 'UPDATE usuario SET Nombre = ?, Correo = ?, Telefono = ?, Tipo = ? WHERE Cedula = ?';
        $stmt = $con->prepare($sql);
        $stmt->bind_param('sssii', $nom, $corr, $tel, $typ, $ci);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function RegistrarUsuario($Cedula, $Nombre, $Telefono, $Correo, $Contrasena, $Tipo) {
        try {

            /* Validaciones de formatos de cedula y correo
            if (!preg_match('/^[0-9]{8}$/', $Cedula)) {
                echo "<script> alert('La cedula debe tener exactamente 8 numeros'); </script>";
            }*/
            if ($Cedula[0] == "0") {
                echo "<script> alert('La cedula no puede comenzar con 0'); </script>";
            }
            if (!filter_var($Correo, FILTER_VALIDATE_EMAIL)) {
                echo "<script> alert('El formato del correo no es valido'); </script>";
            }
    
            $con = $this->getConexion();
    
            // Verificar duplicados
            $sqlCheck = "SELECT Cedula, Nombre, Correo FROM usuario WHERE Cedula = ?  OR Correo = ?";
            $stmtCheck = $con->prepare($sqlCheck);
            if (!$stmtCheck) {
                throw new Exception("Error al preparar la verificación: " . $con->error);
            }
            $stmtCheck->bind_param("is", $Cedula,  $Correo);
            $stmtCheck->execute();

            $resultado = $stmtCheck->get_result();
    
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    if ($fila['Cedula'] == $Cedula) {
                        echo "<script> alert('Ya existe un usuario con esa cedula'); </script>";
                    }
                 
                    if ($fila['Correo'] == $Correo) {
                        echo "<script> alert('Ya existe un usuario con ese Correo'); </script>";
                    }
                }
            }
    
            // Insertar
            $sqlInsert = "INSERT INTO usuario (Cedula, Nombre, Telefono, Correo, pass, Tipo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsert = $con->prepare($sqlInsert);
            $stmtInsert->bind_param("issssi",$Cedula,$Nombre, $Telefono, $Correo, $Contrasena, $Tipo);
            $stmtInsert->execute();
            if (!$stmtInsert->execute()) {
                throw new Exception("Error al insertar: " . $stmtInsert->error);
            }
            return true;
    
        } catch (Exception $e) {
            return $e->getMessage() ?: "Error desconocido al registrar usuario.";
        }


    }
    public function RemUsr($ci){
        try {
            $con = $this->getConexion();
            $sql = 'remove * from usuario where Cedula=?';
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $ci);
            $stmt->execute();
            $sql = "select * from usuario where Cedula=?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("i", $ci);
            $stmt->execute();
            $res = $stmt->get_result();
            if($res->num_rows > 0){
                echo "<script> alert('El usuario no pudo ser removido, consulte con mantenimiento.'); </script>";
            }else{
                echo "<script> alert('El usuario fue removido exitosamente'); </script>";
            }


        } catch (Exception $e) {
            return $e->getMessage() ?: "Error desconocido al remover usuario.";
        }
    }
    
    
}