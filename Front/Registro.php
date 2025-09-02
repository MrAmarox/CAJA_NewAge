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
        <a href="IndexMolsy.php"> <img src="Img/logo.png" alt="logo" > </a>
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
      <label> Contraseña: </label> <input type="password" name="contraseña">
      
      <input type="submit" name="Registrarse" value="Registrarse ">
</form>
</div>

<?php
      if(isset($_POST['Registrarse'])) {
          
        $usuario = new Usuario();
          $usuario->setNombre($_POST['nombre']);
          $usuario->setCedula($_POST['cedula']);
          $usuario->setTelefono($_POST['telefono']);
          $usuario->setCorreo($_POST['correo']);
          $usuario->setContrasena($_POST['contraseña']);
          $usuario->setTipo("Cliente");

          $resultado=$usuario->RegistrarUsuario();
    
          $_SESSION['Clientes'][] = $usuario;         
      if ($resultado === true){
      header("Location: login.php");
      } 

    }
  ?>
</body>
</html>