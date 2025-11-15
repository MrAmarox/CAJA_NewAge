<?php
include_once 'conexion.php';
include_once '../Logica/venta.php';
include_once 'productoBD.php';
class ventaBD extends conexion{

    public function newVenta($venta){
        $Cedula = $venta->getCliente();
        $contacto = $venta->getTel();
        $pago = $venta->getPago();
        $destino = $venta->getDestino();
        $prods = $venta->getProds();
        $total = $venta->getMonto();
        $estado = $venta->getEstado();
        $con = $this->getConexion();
        $succ = true;
        $trouble = '';
        $con->begin_transaction();

        $sql = "INSERT into venta (Cedula, contacto, pago, destino, total, estado) values (?,?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("isssis", $Cedula, $contacto, $pago, $destino, $total, $estado);
        if (!$stmt->execute()) {
            $succ = false;
        }
        $idVenta=$con->insert_id;
        $pBD = new productoBD();
        foreach($prods as $idprod => $unid){
            if($pBD->checkStock($idprod, $unid)){
                $sql = 'INSERT into detalleVenta (idVenta, IDProducto, unidades) values (?,?,?)';
                $stmnt = $con->prepare($sql);
                $stmnt->bind_param('iii', $idVenta, $idprod, $unid);
                if(!$stmnt->execute()){
                    $succ=false;
                }
            }else{
                $succ = false;
                $trouble = 'El stock no es suficiente, disminuya la cantidad de unidades e intente nuevamente.';
            }
        }
        if($succ){
            $con->commit();
            $ret = true;
            if($pago === 'Pago realizado con tarjeta.' || $pago === 'Pago realizado.'){
                foreach ($prods as $idprod => $unid) {
                    Producto::redStock($idprod, $unid);
                }
            }
        }else{
            $con->rollback();
            echo '<script>alert("error al procesar la compra, intente nuevamente, en caso de continuar fallando contacte con soporte. '.$trouble.'");</script>';
            $ret = false;
        }
        return $ret;
    }

    /*
            Este método recibe $wparam(indica el retorno), y $param(indica que retornar(case 0))
            case 0: requiere $param como Cedula, retorna un array de todas las ventas correspondientes al usuario especificado, como objetos venta.
            case 1: no requiere $param, retorna $ventas que es un array de todas las ventas, como objetos venta.
            case 2: requiere $param como idVenta, retorna un array de la venta correspondiente al idVenta especificado, como objeto venta.
    */
    public function bringVentas($wparam, $param){
        $con = $this->getConexion();
        switch ($wparam){
            case 0:
                $sql = "SELECT 
                        v.idVenta, 
                        v.fecha, 
                        v.Cedula, 
                        v.contacto, 
                        v.pago, 
                        v.destino, 
                        v.total,
                        v.estado, 
                        d.idDetalle, 
                        d.IDProducto, 
                        d.unidades
                        FROM venta v
                        JOIN detalleVenta d ON v.idVenta = d.idVenta
                        WHERE v.Cedula = ?";

                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $param);
                $stmt->execute();
                $result = $stmt->get_result();

                $ventas = [];

                while ($row = $result->fetch_assoc()) {
                    $idVenta = $row['idVenta'];

                    if (!isset($ventas[$idVenta])) {
                        $venta = new Venta();
                        $venta->setIdVenta($idVenta);
                        $venta->setFecha($row['fecha']);
                        $venta->setCliente($row['Cedula']);
                        $venta->setTel($row['contacto']);
                        $venta->setPago($row['pago']);
                        $venta->setDestino($row['destino']);
                        $venta->setMonto($row['total']);
                        $venta->setEstado($row['estado']);
                        $ventas[$idVenta] = $venta;
                    }
                    
                    // Agregamos el detalle a la venta correspondiente
                    if (empty($ventas[$idVenta]->getProds())) {
                        $flag[$row['IDProducto']] = $row['unidades'];
                        $ventas[$idVenta]->setProds($flag);
                    } else {
                        $prods[] = $ventas[$idVenta]->getProds();
                        $prods[$row['IDProducto']] = $row['unidades'];
                        $ventas[$idVenta]->setProds($prods);
                    }
                }

                return $ventas;


            case 1:
                $sql = "SELECT 
                        v.idVenta, 
                        v.fecha, 
                        v.Cedula, 
                        v.contacto, 
                        v.pago, 
                        v.destino, 
                        v.total,
                        v.estado,
                        d.idDetalle, 
                        d.IDProducto, 
                        d.unidades
                        FROM venta v
                        JOIN detalleVenta d ON v.idVenta = d.idVenta
                        ORDER BY v.idVenta";

                $stmt = $con->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $ventas = [];
                while ($row = $result->fetch_assoc()) {
                    $idVenta = $row['idVenta'];

                    if (!isset($ventas[$idVenta])) {
                        $venta = new Venta();
                        $venta->setIdVenta($idVenta);
                        $venta->setFecha($row['fecha']);
                        $venta->setCliente($row['Cedula']);
                        $venta->setTel($row['contacto']);
                        $venta->setPago($row['pago']);
                        $venta->setDestino($row['destino']);
                        $venta->setMonto($row['total']);
                        $venta->setEstado($row['estado']);
                        $ventas[$idVenta] = $venta;
                    }
                    // Agregamos el detalle a la venta correspondiente
                    if(empty($ventas[$idVenta]->getProds())){
                        $flag[ $row['IDProducto'] ] = $row['unidades'];
                        $ventas[$idVenta]->setProds($flag);
                    }else{
                        $prods[]=$ventas[$idVenta]->getProds();
                        $prods[ $row['IDProducto'] ] = $row['unidades'];
                        $ventas[$idVenta]->setProds($prods);
                    }
                }
                return $ventas;
            case 2:
                $sql = "SELECT 
                        v.idVenta, 
                        v.fecha, 
                        v.Cedula, 
                        v.contacto, 
                        v.pago, 
                        v.destino, 
                        v.total,
                        v.estado, 
                        d.idDetalle, 
                        d.IDProducto, 
                        d.unidades
                        FROM venta v
                        JOIN detalleVenta d ON v.idVenta = d.idVenta
                        WHERE v.idVenta = ?";

                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $param);
                $stmt->execute();
                $result = $stmt->get_result();

                $ventas = [];

                while ($row = $result->fetch_assoc()) {
                    $idVenta = $row['idVenta'];

                    if (!isset($ventas[$idVenta])) {
                        $venta = new Venta();
                        $venta->setIdVenta($idVenta);
                        $venta->setFecha($row['fecha']);
                        $venta->setCliente($row['Cedula']);
                        $venta->setTel($row['contacto']);
                        $venta->setPago($row['pago']);
                        $venta->setDestino($row['destino']);
                        $venta->setMonto($row['total']);
                        $venta->setEstado($row['estado']);
                        $ventas[$idVenta] = $venta;
                    }

                    // Agregamos el detalle a la venta correspondiente
                    if (empty($ventas[$idVenta]->getProds())) {
                        $flag[$row['IDProducto']] = $row['unidades'];
                        $ventas[$idVenta]->setProds($flag);
                    } else {
                        $prods[] = $ventas[$idVenta]->getProds();
                        $prods[$row['IDProducto']] = $row['unidades'];
                        $ventas[$idVenta]->setProds($prods);
                    }
                }

                return $ventas;
            default:

                break;
        }
    }

    public function modEstado($idVenta, $estado){
        $conexion = $this->getConexion();
        $sql = "UPDATE venta set estado = ? where idVenta = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("si", $estado, $idVenta);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function modPago($idVenta, $pago){
        $conexion = $this->getConexion();
        $sql = "UPDATE venta set pago = ? where idVenta = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("si", $pago, $idVenta);
        if($pago === 'Pago realizado con tarjeta.' || $pago === 'Pago realizado.'){
            $dvents = $this->bringVentas(2,$idVenta);
            foreach($dvents as $dventa){
                $prods[] = $dventa->getProds();
                foreach($prods as $idprod => $unid){
                    Producto::redStock($idprod, $unid);
                }
            }
        }
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


}

?>