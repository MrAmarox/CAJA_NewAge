<?php
include_once "../Logica/productos.php";
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de admin</title>
    <link rel="stylesheet" href="EstiloPanelAdmin.css">
</head>
<body>
    <h2> Agregar un producto como admin: </h2>
    <div>
    <form action="" method="post" enctype="multipart/form-data">
      <label> Nombre </label> <input type="text" name="nombre">
      <br>
      <label> Precio </label> <input type="number" name="precio">
      <br>
      <label> Color </label> <input type="text" name="color">
      <br>
      <label> Talle </label> <input type="text" name="talle">
      <br>
      <label> Foto </label> <input type="file" name="image">

      <br>
      <input type="submit" name="agregar">
    </form>
</div>

</body>
</html>

<?php
    if(isset($_POST['agregar'])) {

        $producto = new Producto();
        $producto->setNombre($_POST['nombre']);
        $producto->setPrecio($_POST['precio']);
        $producto->setColor($_POST['color']);
        $producto->setTalle($_POST['talle']);

       $foto = CargarImagen();
       if ($foto !=null){
        $producto->setFoto($foto);
        }
       $_SESSION['Producto'][]= $producto;

        echo "
            <table class=tabla-producto>
                <tr> 
                    <th> Nombre </th>
                    <th> Precio </th>
                    <th> Color </th>
                    <th> Talle </th>
                    <th> Foto </th>
                </tr>
                <tr>
                    <td>". $producto->getNombre() ."</td>
                    <td>". $producto->getPrecio() ."</td>
                    <td>". $producto->getColor() ."</td>
                    <td>". $producto->getTalle() ."</td>
                    <td> <img src='/Img/". $producto->getFoto() ."'></td>
                </tr>
            </table>";
    }

    if(isset($_SESSION['usuario'])){
        echo "
        <br>
        <h2> Usuarios registrados: </h2>
        <table class=tabla-usuarios>
            <tr> 
               <th> Nombre </th>
               <th> Celular </th>
               <th> Correo </th>
               <th> Contraseña </th>
               <th> Tipo </th>
            </tr>";

        foreach ($_SESSION['usuario'] as $usuario){
            echo "
                <tr>
                    <td>". $usuario->getNombre() ."</td>
                    <td>". $usuario->getCelular() ."</td>
                    <td>". $usuario->getCorreo() ."</td>
                    <td>". $usuario->getPass() ."</td>
                    <td>". $usuario->getTipo() ."</td>
                </tr>";      
        }
        echo "</table>";
    }
?>