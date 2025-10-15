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
                    <input type="password" name="pass">
                    <br>
                    <input type="submit" value="Iniciar Sesión" name="submit">
                    <p> ¿No tienes cuenta de usuario? <br> Registrate para ser parte de Molsy </p>
                    <button type="button" class="btn" onclick="window.location.href='Registro.php'">Registrarse</button>

                </form>
            </div>
        </div>
</body>
</html>

<?php
include_once "../Logica/usuario.php";
session_start();
if (isset($_POST['submit'])) {
    $u= usuario::Login($_POST['correo'],$_POST['pass']);
    if(is_object($u)){
        switch ($u->getTipo()){
            case 0:
                header("Location:PanelAdminMolsy.php");
                $_SESSION['usr'] = $u;//inicia la variable usr, que almacena el objeto usuario correspondiente al usuario logueado;
                break;
            case 1:
                header("Location:PanelUser.php");
                $_SESSION['usr'] = $u;
                break;
            case 2:
                header("Location:PanelAdminMolsy.php");
                $_SESSION['usr'] = $u;
                break;
            default:
            header("Location:Registro.php");
        }
  
    }else{
        switch ($u){
            case 1:
                echo "Contraseña incorrecta";
                break;
            case 2:
                echo 'Correo incorrecto';
                break;
            default:
                echo 'Error desconocido';
                break;
        }   
    }
  
  }

  if (isset($_POST['Registrarse'])){
      header("Location: Registro.php");
  }

?>


