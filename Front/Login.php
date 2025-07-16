<?php
include_once "../Logica/usuario.php";
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
        <label for=""> Correo </label><input type="text" name="email">
        <br>
        <label for=""> Contraseña </label><input type="text" name="pass">
        <br>
        <input type="submit" value="Iniciar Sesion" name="Login">
        <input type="submit" value="Registrarse" name="Register">
    </form>
    <?php

    if(isset($_POST['Register'])){
        header("Location:Registro.php");
    }
    $encontrado=false;
    if(isset($_POST["login"])) {
        foreach($_SESSION['usuarios'] as $usuario){
            if ($usuario ->getCorreo()==$_POST['email'] && $usuario->getPass()==$_POST['pass']){
                $encontrado=true;
                if($usuario->gettipo()== 'admin'){
                    header('');//panel de admin
                }else{
                    header('location:IndexMolsy.php');
                }
        }
    }
    if(!$encontrado){
            echo "<script>
            alert('Usuario o contraseña incorrectos');
            </script>";
        }
    }
    ?>
</body>
</html>
