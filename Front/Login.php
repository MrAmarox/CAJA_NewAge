<?php
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DiseñoLogin.css">
    <title>Login</title>
</head>
<body>
        <div class="logo-container">
        <a href="IndexMolsy.php"> <img src="Img/logo.png" alt="logo" > </a>
        </div>

        <div class="contenido-principal">
            <h2 class="titulo-bienvenida">Bienvenido/a</h2>
            <p class="subtitulo">Iniciá sesión con tu cuenta de usuario Molsy Store.</p>

            <div class="contenedor-login">
                <form method="post">
                    <label>Correo</label>
                    <input type="text" name="correo">
                    <br>
                    <label>Contraseña</label>
                    <input type="password" name="contraseña">
                    <br>
                    <input type="submit" value="Iniciar Sesión" name="Iniciar_Sesion">
                    <p> ¿No tienes cuenta de usuario? <br> Registrate para ser parte de Molsy </p>
                    <button type="button" class="btn" onclick="window.location.href='Registro.php'">Registrarse</button>

                </form>
            </div>
        </div>
</body>
</html>

<?php

// Simulacion de dos usuarios para ejemplo, admin y cliente

$usuario1 = new Usuario("Molly","Catalina","catacss@gmail.com","092958357");
$usuario1->setTipo(0); // El tipo 0 es admin y el tipo 1 es cliente, si a futuro se desea contar con más niveles de acceso, se utilizan números más grandes.
$usuario2 = new Usuario("caniche","Amaru","amaru@gmail.com","099154814");
$usuario2->setTipo(1);

$usuarios= array(
    $usuario1, $usuario2
);

$encontrado=false;
if (isset($_POST['Iniciar_Sesion'])) {
    if($_POST['correo'] != null && $_POST['contraseña'] != null){
        $correo = $_POST['correo'];
        $pass = $_POST['contraseña'];

        foreach ($usuarios as $usuario) {
            if ($usuario->getCorreo() === $correo && $usuario->getPass() === $pass) {
                $encontrado = true;
                break;
            }
        }
        if($encontrado){
            if ($usuario != null) {
                if ($usuario->getTipo() === 0) {
                    header("Location: PanelAdminMolsy.php");
                    exit();
                } elseif($usuario->getTipo() === 1) {
                    header("Location: IndexMolsy.php");
                    exit();
                }
            }
        }else{
            echo '<script>alert("Correo o contraseña incorrectos.");</script>';
        }
        
    }else{
        echo '<script>alert("Por favor, complete todos los campos correctamente.");</script>';
    }
}

?>


