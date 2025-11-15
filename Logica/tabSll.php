<?php
include_once 'venta.php';
include_once 'usuario.php';
session_start();
function tabSll(){
    $f = $_GET['opt']??'';
    if($f===''){
        $sls = Venta::bringVentas(1, 0);
    }else{
        $sls = Venta::bringVentas(0,$f);
    }
    $html = "<div>
        <h2> Ventas registradas: </h2>
        <table class=tabla-ventas>
            <tr> 
                <th> Fecha </th>
                <th> Cédula </th>
                <th> Contacto </th>
                <th> Pago </th>
                <th> Destino </th>
                <th> Estado </th>
                <th> Total </th>
                <th> Acciones </th>
            </tr>";

    if (!empty($sls)) {
        foreach ($sls as $venta) {
            $html .= '
                    <tr>
                        <td>' . $venta->getFecha() . '</td>
                        <td>' . $venta->getCliente() . '</td>
                        <td>' . $venta->getTel() . '</td>
                        <td>' . $venta->getPago() . '</td>
                        <td>' . $venta->getDestino() . '</td>
                        <td>' . $venta->getEstado() . '</td>
                        <td>' . $venta->getMonto() . '</td>
                        <td>';
                        
                        if($_SESSION['usr']->getTipo()===0 || $_SESSION['usr']->getTipo()===2){
                            $html.='<button class="btnmodSll"
                            data-FechaVen="' . htmlspecialchars($venta->getFecha()) . '"
                            data-cli="' . htmlspecialchars($venta->getCliente()) . '"
                            data-cont="' . htmlspecialchars($venta->getTel()) . '"
                            data-pago="' . htmlspecialchars($venta->getPago()) . '"
                            data-destino="' . htmlspecialchars($venta->getDestino()) . '"
                            data-monto="' . htmlspecialchars($venta->getMonto()) . '"
                            data-estado="' . htmlspecialchars($venta->getEstado()) . '"
                            data-idventa="' . htmlspecialchars($venta->getIdVenta()) . '"
                            >Administrar</button></td>';
                        }
                    $html.='</tr>';
        }
        $html .= '</table>';
    } else {
        echo "<script> alert('Ha ocurrido un eror grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
    }
    $html .= "</div>";
    return $html;
}
header('Content-Type: application/json');

// Salida en formato JSON
echo json_encode(tabSll());
