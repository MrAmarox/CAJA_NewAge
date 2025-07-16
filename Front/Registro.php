<?php
include_once "../Logica/usuario.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>

<form action="" method="post">
    <label>Nombre</label><input type="text" name="name"><br>
    <label>Correo</label><input type="text" name="email"><br>
    <label>Contraseña</label><input type="password" name="pass"><br>
    <input type="submit" name="register" value="Register">

</form>
</body>
</html>
<?php
if (isset($_POST['register'])) {
    $usuario = new usuario();
    $usuario->setNombre($_POST['name']);
    $usuario->setCorreo($_POST['email']);
    $usuario->setpass($_POST['pass']);
    $usuario->setTipo('cliente');
    $_SESSION['Usuarios'] []= $usuario;
    header('location: login.php');
}