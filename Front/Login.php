<?php
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
    echo oheader();
    echo menuhamburguesa();
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Presentacion/DiseñoLogin.css">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <label for=""> Correo </label><input type="text" name="correo">
        <br>
        <label for=""> Contraseña </label><input type="text" name="contraseña">
        <br>
        <input type="submit" value="Iniciar Sesion" name="Login">
        <input type="submit" value="Registrarse" name="Register">
    </form>
    <?php

    if(isset($_POST['Register'])){
        header("Location:Registro.php");
    }
    $encontrado=false;
    if (isset($_POST['Iniciar_Sesion'])) {
        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];
    
      
    
        foreach ($usuarios as $Usuario) {
            $correoo = $Usuario->getCorreo();
            $contraseñaa = $Usuario->getContraseña();
            if ($correoo == $correo && $contraseñaa == $contraseña) {
                break;
            }else {
                echo "<p> Error en correo o contraseña </p>";
            }
        }
    
        if ($Usuario != null) {
            if ($Usuario->getTipo() == "Admin") {
                header("Location: panelAdmin.php");
                exit();
            } else {
                header("Location: IndexMolsy.php");
                exit();
            }
        } 
    }
    echo '<main style="min-height: 60vh;">
    </main>';
    echo ofooter();
    ?>
</body>
</html>