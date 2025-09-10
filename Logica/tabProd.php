<?php
include_once 'producto.php';
include_once 'SubCat.php';

function tabProd()
{
    $prods = Producto::listarProductos(0, 0);
    $html = "
        <h2> Productos registrados: </h2>
        <table class=tabla-productos>
            <tr> 
                <th> Nombre </th>
                <th> Color </th>
                <th> Precio </th>
                <th> Talle </th>
                <th> Subcategoría </th>
                <th> Foto </th>
            </tr>";
    
    if (!empty($prods)) {
        foreach ($prods as $prod) {
            $SubCat = SubCat::bringSubcat($prod->getSubcatID());
            $html .= "
                <tr>
                    <td>" . $prod->getNombre() . "</td>
                    <td>" . $prod->getColor() . "</td>
                    <td>$" . $prod->getPrecio() . "</td>
                    <td>" . $prod->getTalle() . "</td>
                    <td>" . $SubCat->getNombre() . "</td>
                    <td><img src='../Front/Img/".$prod->getFoto()."'></td>
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
echo json_encode(tabProd());
