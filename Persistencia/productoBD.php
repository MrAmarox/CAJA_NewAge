<?php
include_once "conexion.php";
include_once "../Logica/productos.php";

class productoBD extends conexion{

    //insertar
    public function AñadirProducto($nombre, $precio, $color, $talle, $foto)
    {
        $conexion = $this->getConexion();
        $sql = "Insert into productos (Nombre, precio, color, talle, foto) values (?,?,?,?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sisss", $nombre, $precio, $color, $talle, $foto);
        $stmt->execute();
    }

    //listar
    public function listarProductos()
    {
        $conexion = $this->getConexion();
        $sql = "select * from productos";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $productos = new producto();
        $resultado = $stmt->get_result();
        $productolista = [];
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $producto = new producto();
                $producto->setIDProducto($fila['IDProducto']);
                $producto->setNombre($fila['Nombre']);
                $producto->setPrecio($fila['Precio']);
                $producto->setColor($fila['Color']);
                $producto->setTalle($fila['Talle']);
                $producto->setFoto($fila['Foto']);
                $productolista[] = $producto;
            }
        }
        return $productolista;
    }
}