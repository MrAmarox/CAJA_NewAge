<?php
include_once "conexion.php";
include_once "../Logica/producto.php";

class productoBD extends conexion{

    //insertar
    public function AddProducto($nombre, $precio, $color, $talle, $foto, $estado, $subcatID, $stock, $descripcion){
        $conexion = $this->getConexion();
        $sql = "INSERT into productos (nombre, precio, color, talle, foto, estado, subcatID, stock, descripcion) values (?,?,?,?,?,?,?,?,?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("sisssiiis", $nombre, $precio, $color, $talle, $foto, $estado, $subcatID, $stock, $descripcion);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    //listar
    /*
        Este metodo recibe 2 parámetros $wpar y $param:

            $wpar(qué parámetro)->Indica la opción de listar productos deseada.
                0: devuelve un arreglo de todos los productos.
                1: devuelve un arreglo de todos los productos correspondientes a una subcategoría (especificada con $param).
                2: devuelve un arreglo de todos los productos correspondientes a una categoría (especificada con $param).
                3: devuelve el objeto correspondiente a un IDProducto (especificado con $param).

            $param(parámetro)->Es el valor necesario para la opcion seleccionada(si la opcion es 0 entonces debe dársele un valor 0).
    */
    public function listarProductos($wpar, $param){

        $conexion = $this->getConexion();
        $flag=true;
        switch ($wpar) {
            case 0:
                $sql = "SELECT * from productos";
                $stmt = $conexion->prepare($sql);
                $stmt->execute();
                break;
            case 1:
                $sql = "SELECT * from productos where subcatID=?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("i", $param);
                $stmt->execute();
                break;
            case 2:
                $sql = "SELECT 
                            p.IDProducto,
                            p.nombre,
                            p.precio,
                            p.color,
                            p.talle,
                            p.foto,
                            p.estado,
                            p.stock,
                            p.descripcion,
                            sc.nombre AS subcategoria,
                            sc.subcatID AS subcatID,
                            c.nombre AS categoria
                        FROM productos p
                        JOIN subcategoria sc ON p.subcatID = sc.subcatID
                        JOIN categoria c ON sc.catID = c.catID
                        WHERE c.catID = ?;";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("i", $param);
                $stmt->execute();
                break;
            case 3:
                $sql = "SELECT * from productos where IDProducto=?";
                $stmt = $conexion->prepare($sql);
                $stmt->bind_param("i", $param);
                $stmt->execute();
                $flag=false;
                break;
            default:
                echo "<script> alert('Ha ocurrido un eror grave, será redirigido a la página de inicio en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
                break;
        }
        $resultado = $stmt->get_result();
        if($flag==true){
            $productolista = [];
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $producto = new producto($fila['nombre'], $fila['precio'], $fila['color'], $fila['talle'], $fila['foto'], $fila['subcatID'], $fila['estado']);
                    $producto->setIDProducto($fila['IDProducto']);
                    $producto->setStock($fila['stock']);
                    $producto->setDesc($fila['descripcion']);
                    $productolista[] = $producto;
                }
                return $productolista;
            }
        }else{
            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    $producto = new producto($fila['nombre'], $fila['precio'], $fila['color'], $fila['talle'], $fila['foto'], $fila['subcatID'], $fila['estado']);
                    $producto->setIDProducto($fila['IDProducto']);
                    $producto->setStock($fila['stock']);
                    $producto->setDesc($fila['descripcion']);
                }
                return $producto;
            }
        }
    }
    public function modProd($prod){
        $nam=$prod->getNombre();
        $pre=$prod->getPrecio();
        $col=$prod->getColor();
        $tal=$prod->getTalle();
        $img=$prod->getFoto();
        $est=$prod->getEstado();
        $id=$prod->getIDProducto();
        $stock=$prod->getStock();
        $desc=$prod->getDesc();
        $con = $this->getConexion();
        $sql = 'UPDATE productos SET nombre = ?, precio = ?, color = ?, talle = ?, foto = ?, estado = ?, stock = ?, descripcion = ? WHERE IDProducto = ?';
        $stmt= $con->prepare($sql);
        $stmt->bind_param('sisssiisi', $nam, $pre, $col, $tal, $img, $est, $stock, $desc, $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    /*
        checkStock recibe un IDProducto y las unidades correspondientes y devuelve 0, 1 o 2 dependiendo del resultado
            -devuelve 1 si hay la misma cantidad de productos en stock que los indicados en $unid.
            -devuelve 2 si hay más en stock de los indicados.
            -devuelve 0 en caso de haber menos.
   */
    public function checkStock($idprod, $unid){
        $conexion = $this->getConexion();
        $sql = "SELECT stock from productos where IDProducto = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $idprod);
        $stmt->execute();
        $res = $stmt->get_result();
        if($res->num_rows > 0 && $fila=$res->fetch_assoc()){
            if($fila['stock']==$unid){
                return 1;
            }elseif($fila['stock']>$unid){
                return 2;
            }
        }else{
            return 0;
        }
    }
}