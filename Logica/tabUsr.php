<?php
include_once 'usuario.php';

function tabUsr()
{
    $usrs = usuario::bringUsrs();
    $html = "
        <br>
        <h2> Usuarios registrados: </h2>
        <table class=tabla-usuarios>
            <tr> 
            <th> Nombre </th>
            <th> Cédula <?th>
            <th> Celular </th>
            <th> Correo </th>
            <th> Tipo </th>
            </tr>";

    if (!empty($usrs)) {
        foreach ($usrs as $usuario) {
            $html.= "
                    <tr>
                        <td>" . $usuario->getNombre() . "</td>
                        <td>" . $usuario->getCi() . "</td>
                        <td>" . $usuario->getCelular() . "</td>
                        <td>" . $usuario->getCorreo() . "</td>
                        <td>" . $usuario->getTipo() . "</td>
                    </tr>";
        }
        $html .= "</table>";
    } else {
        echo "<script> alert('Ha ocurrido un eror grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
    }
    $html .= "</div>";
    return $html;
}
header('Content-Type: application/json');

// Salida en formato JSON
echo json_encode(tabUsr());
