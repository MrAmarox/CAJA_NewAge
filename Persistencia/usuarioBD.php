<?php
include_once "conexion.php";
include_once "../Logica/usuario.php";

class usuarioBD extends conexion {

    public function Login ($correo, $contrasena){

        $con = $this->getConexion();
        $sql = "select * from usuario where Correo=? and Contraseña=?";
        $stmt = $con->prepare($sql);

        $stmt->bind_param("ss", $correo, $contrasena);
        $stmt->execute();

        $resultado = $stmt->get_result();

        $usuario = new Usuario();
        if ($resultado->num_rows > 0){
            while ($fila = $resultado->fetch_assoc()){
                $usuario->setCedula($fila['Cedula']);
                $usuario->setNombre($fila['Nombre']);
                $usuario->setTelefono($fila['Telefono']);
                $usuario->setCorreo($fila['Correo']);
                $usuario->setTipo($fila['Tipo']);
            }
            return $usuario;
        } else {
            return null;
        }
    }

    public function RegistrarUsuario( $Cedula,$Nombre, $Telefono, $Correo, $Contrasena, $Tipo) {
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
            $sqlInsert = "INSERT INTO usuario (Cedula, Nombre, Telefono, Correo, contraseña, Tipo) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsert = $con->prepare($sqlInsert);
            $stmtInsert->bind_param("isssss", $Cedula, $Nombre, $Telefono, $Correo, $Contrasena, $Tipo);
    
            if (!$stmtInsert->execute()) {
                throw new Exception("Error al insertar: " . $stmtInsert->error);
            }
          return true;
    
        } catch (Exception $e) {
            return $e->getMessage() ?: "Error desconocido al registrar usuario.";
        }


    }
    
    
    
}