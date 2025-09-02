<?php
include_once "../Logica/usuario.php";
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
                <label> Contraseña: </label> <input type="password" name="pass" id="pass" onkeyup="chkInpt()">
                <br>
                <label> Repita la contraseña: </label> <input type="password" name="pass2" id="pass2" onkeyup="chkInpt()">
                <br>
                <label id="Wrng" style="color:red;" ></label>
                <br>
                <input type="submit" name="submit" value="Registrarse ">
            </form>
        </div>
        <script>
            function chkInpt(){
                let i1 = document.getElementById('pass').value;
                let i2 = document.getElementById('pass2').value;
                const lbl = document.getElementById('Wrng');
                    if(i1===i2){
                        lbl.textContent = "";
                    }else{
                        lbl.textContent = "Las contraseñas no coinciden";
                    }
            }
        </script>
    </body>
</html>

<?php
    if(isset($_POST['submit'])){
        if (empty($_POST['nombre']) || empty($_POST['celular']) || empty($_POST['correo']) || empty($_POST['pass'] || empty($_POST['pass2']))) {
            echo '<script>alert("Por favor, complete todos los campos correctamente.");</script>';
        }else{
            $correosRegistrados = array_map(function($usuario) {return strtolower($usuario->getCorreo()); }, $_SESSION['usuarios'] ?? []);
            if (!in_array($_POST['correo'], $correosRegistrados)){
                if($_POST['pass'] === $_POST['pass2']){
                    $usuario = new usuario($_POST['correo'],$_POST['pass'],$_POST['ci'],$_POST['nombre'],$_POST['tel']);
                    if(!isset($_SESSION['usuarios'])){
                        $_SESSION['usuarios'] = [];
                    }
                    $_SESSION['usuarios'][] = serialize($usuario);
                }else{
                    echo '<script>alert("Las contraseñas no coinciden.");</script>';
                } 
            }else{
                echo '<script>alert("El correo ingresado ya está registrado.");</script>';

            }
        }
    }
?>
