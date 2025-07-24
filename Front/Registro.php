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
    <link rel="stylesheet" href="DiseñoRegistro.css">
    <title>Registro</title>

</head>
<body>
<div class="logo-container">
        <a href="IndexMolsy.php"> <img src="Img/logo.png" alt="logo" > </a>
</div>

<div class="contenido-principal">
<h2 class="titulo-bienvenida">Bienvenido/a</h2>
<p class="subtitulo">Crea una cuenta de usuario para ser parte de Molsy Store.</p>
<form action="" method="post">
      <label> Nombre: </label> <input type="text" name="nombre">
      <br>
      <label> Celular: </label> <input type="number" name="celular">
      <br>
      <label> Correo: </label> <input type="email" name="correo">
      <br>
      <label> Contraseña: </label> <input type="password" name="contraseña">
      <br>
      <label> Tipo: </label> <input type="Text" name="tipo">
      <br>
      <input type="submit" name="Registrarse" value="Registrarse ">
</form>
</div>

<?php
if (isset($_POST['Registrarse'])) {

    $usuario = new usuario();
    $usuario->setNombre($_POST['nombre']);
    $usuario->setCelular($_POST['celular']);
    $usuario->setCorreo($_POST['correo']);
    $usuario->setPass($_POST['contraseña']);
    $usuario->setTipo($_POST['tipo']);

    $_SESSION['usuario'] [] = $usuario;
}
?>
</body>
</html>