<?php
include_once 'conexion.php';
include_once '../Logica/venta.php';
include_once 'productoBD.php';
class ventaBD extends conexion{


    public function newVenta($venta){
        $Cedula = $venta->getCliente();
        $contacto = $venta->getTelcont();
        $pago = $venta->getPago();
        $destino = $venta->getDestino();
        $prods = $venta->getProds();
        $total = $venta->getMonto();
        $con = $this->getConexion();
        $succ = true;
        $con->begin_transaction();

        $sql = "INSERT into venta (Cedula, contacto, pago, destino, total) values (?,?,?,?,?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("isssi", $Cedula, $contacto, $pago, $destino, $total);
        if (!$stmt->execute()) {
            $succ = false;
        }
        $idVenta=$con->insert_id;
        $pBD = new productoBD();
        foreach($prods as $idprod => $unid){
            if($pBD->checkStock($idprod, $unid)){
                $sql = 'INSERT into detalleVenta (idVenta, IDProducto, unidades) values (?,?,?)';
                $stmt = $con->prepare($sql);
                $stmt->bind_param('iii', $idVenta, $idprod, $unid);
                if(!$stmt->execute()){
                    $succ=false;
                }
            }
        }
        if($succ){
            $con->commit();
        }else{
            $con->rollback();
        }
    }

    /*
            Este método recibe $wparam(indica el retorno), y $param(indica que retornar(case 0))
            case 0: requiere $param como Cedula, retorna todas las ventas correspondientes al usuario especificado, con la misma estructura que el case 1.
            case 1: no requiere $param, retorna $ventas que es un array de todas las ventas, con esta estructura:
                $ventas = [
                            idVenta_1 => [
                                            'idVenta' => int,
                                            'fecha' => string (YYYY-MM-DD HH:MM:SS),
                                            'Cedula' => int,
                                            'contacto' => string,
                                            'pago' => string,
                                            'destino' => string,
                                            'total' => float,
                                            'detalles' => [
                                                            [
                                                                'idDetalle' => int,
                                                                'IDProducto' => int,
                                                                'unidades' => int
                                                            ],
                                                            // más productos...
                                                        ]
                                        ],
                            idVenta_2 => [
                                            // misma estructura que arriba
                                        ],
                            // más ventas...
                        ];
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

                    // Si la venta no está registrada aún, la creamos
                    if (!isset($ventas[$idVenta])) {
                        $ventas[$idVenta] = [
                            'idVenta' => $idVenta,
                            'fecha' => $row['fecha'],
                            'Cedula' => $row['Cedula'],
                            'contacto' => $row['contacto'],
                            'pago' => $row['pago'],
                            'destino' => $row['destino'],
                            'total' => $row['total'],
                            'detalles' => []
                        ];
                    }

                    // Agregamos el detalle a la venta correspondiente
                    $ventas[$idVenta]['detalles'][] = [
                        'idDetalle' => $row['idDetalle'],
                        'IDProducto' => $row['IDProducto'],
                        'unidades' => $row['unidades']
                    ];
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
                        d.idDetalle, 
                        d.IDProducto, 
                        d.unidades
                        FROM venta v
                        JOIN detalleVenta d ON v.idVenta = d.idVenta
                        ORDER BY v.idVenta";

                $result = $con->query($sql);
                $ventas = [];
                while ($row = $result->fetch_assoc()) {
                    $idVenta = $row['idVenta'];
                    if (!isset($ventas[$idVenta])) {
                        $ventas[$idVenta] = [
                            'idVenta' => $idVenta,
                            'fecha' => $row['fecha'],
                            'Cedula' => $row['Cedula'],
                            'contacto' => $row['contacto'],
                            'pago' => $row['pago'],
                            'destino' => $row['destino'],
                            'total' => $row['total'],
                            'detalles' => []
                        ];
                    }

                    $ventas[$idVenta]['detalles'][] = [
                        'idDetalle' => $row['idDetalle'],
                        'IDProducto' => $row['IDProducto'],
                        'unidades' => $row['unidades']
                    ];
                }
                return $ventas;
            case 2:
                $sql = "SELECT v.idVenta, v.fecha, v.Cedula, v.contacto, v.pago, v.destino, v.total, d.idDetalle, d.IDProducto, d.unidades FROM venta v JOIN detalleVenta d ON v.idVenta = d.idVenta WHERE v.Cedula = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $param);
                $stmt->execute();
                $result = $stmt->get_result();
                $venta = null;
                $detalles = [];
                while ($row = $result->fetch_assoc()) {
                    if (!$venta) {
                        $venta = ['idVenta' => $row['idVenta'], 'fecha' => $row['fecha'], 'Cedula' => $row['Cedula'], 'contacto' => $row['contacto'], 'pago' => $row['pago'], 'destino' => $row['destino'], 'total' => $row['total']];
                    }
                    $detalles[] = ['idDetalle' => $row['idDetalle'], 'IDProducto' => $row['IDProducto'], 'unidades' => $row['unidades']];
                }
                return ['venta' => $venta, 'detalles' => $detalles];
            default:

                break;
        }
    }
}

?>