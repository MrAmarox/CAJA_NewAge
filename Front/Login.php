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
                    <input type="submit" value="Registrarse" name="Register">
                </form>
            </div>
        </div>
</body>

<?php

// Simulacion de dos usuarios para ejemplo, admin y cliente

$usuario1 = new Usuario();
$usuario1->setNombre("Catalina");
// $usuario1->setCelular(092958357);
$usuario1->setCorreo("catacss@gmail.com");
$usuario1->setPass("Molly");
$usuario1->setTipo("Admin");

$usuario2 = new Usuario();
$usuario2->setNombre("Amaru");
//$usuario2->setCelular(092958357);
$usuario2->setCorreo("amaru@gmail.com");
$usuario2->setPass("caniche");
$usuario2->setTipo("Cliente");

$usuarios= array(
    $usuario1, $usuario2
);
if(isset($_POST['Register'])){
    header("Location:Registro.php");
}

$encontrado=false;
if (isset($_POST['Iniciar_Sesion'])) {
    $correo = $_POST['correo'];
    $pass = $_POST['contraseña'];

    foreach ($usuarios as $usuario) {
        $correoo = $usuario->getCorreo();
        $contraseñaa = $usuario->getPass();
        if ($correoo == $correo && $contraseñaa == $pass) {
            break;
        } else {
            echo "<p> Correo o contraseña incorrectos. </p>";
        }
    }

    if ($usuario != null) {
        if ($usuario->getTipo() == "Admin") {
            header("Location: PanelAdminMolsy.php");
            exit();
        } else {
            header("Location: IndexMolsy.php");
            exit();
        }
    }
}

?>
</body>
</html>

