<?php
include_once 'usuario.php';

function tabUsr()
{
    $usrs = usuario::bringUsrs();
    $html = "<div>
        <h2> Usuarios registrados: </h2>
        <table class=tabla-usuarios>
            <tr> 
                <th> Nombre </th>
                <th> Cédula </th>
                <th> Celular </th>
                <th> Correo </th>
                <th> Tipo </th>
                <th> Acciones </th>
            </tr>";

    if (!empty($usrs)) {
        foreach ($usrs as $usuario) {
            $html.= '
                    <tr>
                        <td>' . $usuario->getNombre() . '</td>
                        <td>' . $usuario->getCedula() . '</td>
                        <td>' . $usuario->getTelefono() . '</td>
                        <td>'. $usuario->getCorreo() . '</td>
                        <td>' . $usuario->getTipo() . '</td>
                        <td><button class="btnmodUsr"
                            data-nombreusr="' . htmlspecialchars($usuario->getNombre()) . '"
                            data-ci="' . htmlspecialchars($usuario->getCedula()) . '"
                            data-corr="' . htmlspecialchars($usuario->getCorreo()) . '"
                            data-tel="' . htmlspecialchars($usuario->getTelefono()) . '"
                            data-tipo="' . htmlspecialchars($usuario->getTipo()) . '"
                        >Modificar</button></td>
                    </tr>';
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
echo json_encode(tabUsr());
