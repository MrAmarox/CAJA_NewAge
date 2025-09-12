<?php
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";

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
        <a href="IndexMolsy.php"> <img src="Img/logo.png" alt="logo"> </a>
    </div>

    <div class="contenido-principal">
        <h2 class="titulo-bienvenida">Bienvenido/a</h2>
        <p class="subtitulo">Crea una cuenta de usuario para ser parte de Molsy Store.</p>
        <form action="" method="post">
            <label> Cedula: </label> <input type="text" name="cedula">
            <br>
            <label> Nombre: </label> <input type="text" name="nombre">
            <br>
            <label> Telefono: </label> <input type="number" name="telefono">
            <br>
            <label> Correo: </label> <input type="email" name="correo">
            <br>
            <label> Contraseña: </label> <input type="password" name="pass" id="pass">
            <br>
            <label> Repita la contraseña: </label> <input type="password" name="pass2" id="pass2" onkeyup="chkInpt()">
            <br>
            <label id="Wrng" style="color:red;"></label>
            <br>
            <input type="submit" name="submit" value="Registrarse ">
        </form>
    </div>
</body>

<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['nombre']) || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['pass'] || empty($_POST['pass2']))) {
        echo '<script>alert("Por favor, complete todos los campos correctamente.");</script>';
    } else {
        if ($_POST['pass'] === $_POST['pass2']) {
            $pas=$_POST['pass'];
            $usuario = new usuario($_POST['cedula'], $_POST['nombre'], $_POST['correo'], $_POST['telefono']);
            $usuario->RegistrarUsuario($pas);
            header("Location:../Front/IndexMolsy.php");
        } else {
            echo '<script>alert("Las contraseñas no coinciden.");</script>';
        }
    }
}
?>
<script>
    const pwd = document.getElementById('pass');
    const confirmPwd = document.getElementById('pass2');
    const msg = document.getElementById('Wrng');

    function chkInpt() {
        if (confirmPwd.value === '') {
            msg.textContent = '';
            msg.style.color = '';
        } else if (pwd.value === confirmPwd.value) {
            msg.textContent = '✔ Las contraseñas coinciden';
            msg.style.color = 'green';
        } else {
            msg.textContent = '✘ Las contraseñas no coinciden';
            msg.style.color = 'red';
        }
    }
</script>