<?php
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
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
include_once "../Logica/usuario.php";
if (isset($_POST['IniciarSesion'])) {
    $u= usuario::Login($_POST['correo'],$_POST['contraseña']);
    if($u != null){
        $_SESSION['Cliente']=$u;
        switch ($u->getTipo()){
            case 0:
                header("Location:panelAdmin.php");
                break;
            case 1;
                header("Location:../index.php");
                break;
        }
  
    }else{
        echo "Usuario o contraseña incorrectas";
    }
  
  }

  if (isset($_POST['Registrarse'])){
      header("Location: Registro.php");
  }

?>


