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
    <title>Registro</title>
</head>
<body>

<form action="" method="post">
    <label>Correo</label><br>
        <input type="email" name="correo" required><br>
        <label>Contraseña</label><br>
        <input type="password" id="pass" name="pass" required><br>
        <label>Repita la contraseña</label><br>
        <input type="password" id="pass2" name="pass2" required><br>
        <label>Nombre completo</label><br>
        <input type="text" name="nombre" required><br>
        <label>Teléfono</label><br>
        <input type="text" name="tel" required pattern="[0-9]+"><br>
        <label>Cédula de identidad</label><br>
        <input type="text" name="ci" required><br>
        <input type="submit" name="submit" value="REGISTRARSE">

</form>
</body>
</html>
<?php
    include_once "../Logica/usuario.php";
    
    if(isset($_POST['submit'])){
        $correosRegistrados = array_map(function($cliente) {return strtolower($cliente->getCorreo()); }, $_SESSION['usuarios'] ?? []);
        if (in_array($_POST['correo'], $correosRegistrados)) {
            if($_POST['pass'] == $_POST['pass2']){
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
    echo ofooter();
?>