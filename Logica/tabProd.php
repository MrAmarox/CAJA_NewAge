<?php
include_once 'producto.php';
include_once 'SubCat.php';

function tabProd(){
    $prods = Producto::listarProductos(0, 0);
    $html = "
        <h2> Productos visibles: </h2>
        <table class=tabla-productos>
            <tr> 
                <th> Nombre </th>
                <th> Color </th>
                <th> Precio </th>
                <th> Talle </th>
                <th> Subcategoría </th>
                <th> Estado </th>
                <th> Foto </th>
                <th> Acciones </th>
            </tr>";

    if (!empty($prods)) {
        foreach ($prods as $prod) {
            if($prod->getEstado()==1){
                $SubCat = SubCat::bringSubcat($prod->getSubcatID());
                $html .= "
                    <tr>
                        <td>" . $prod->getNombre() . "</td>
                        <td>" . $prod->getColor() . "</td>
                        <td>" . $prod->getPrecio() . "</td>
                        <td>" . $prod->getTalle() . "</td>
                        <td>" . $SubCat->getNombre() . "</td>
                        <td>" . $prod->getEstado() . "</td>
                        <td><img src='../Front/Img/".$prod->getFoto(). "'></td>
                        <td><button class='btnmodProd'
                            data-pic='" . htmlspecialchars($prod->getFoto()) . "'
                            data-id='" . htmlspecialchars($prod->getIDProducto()) . "'
                            data-nombreprod='" . htmlspecialchars($prod->getNombre()) . "'
                            data-color='" . htmlspecialchars($prod->getColor()) . "'
                            data-precio='" . htmlspecialchars($prod->getPrecio()) . "'
                            data-talle='" . htmlspecialchars($prod->getTalle()) . "'
                            data-estado='". htmlspecialchars($prod->getEstado()) . "'
                            data-subcat='" . htmlspecialchars($SubCat->getNombre()) . "'
                        >Modificar</button></td>
                    </tr>";
            }
        }
        $html .= "</table>";
        $html .= '<h2> Productos ocultos: </h2>
        <table class=tabla-productos>
            <tr> 
                <th> Nombre </th>
                <th> Color </th>
                <th> Precio </th>
                <th> Talle </th>
                <th> Subcategoría </th>
                <th> Estado </th>
                <th> Foto </th>
                <th> Acciones </th>
            </tr>';

        foreach($prods as $prod){
            if($prod->getEstado()==0){
                $SubCat = SubCat::bringSubcat($prod->getSubcatID());
                $html .= "
                    <tr>
                        <td>" . $prod->getNombre() . "</td>
                        <td>" . $prod->getColor() . "</td>
                        <td>" . $prod->getPrecio() . "</td>
                        <td>" . $prod->getTalle() . "</td>
                        <td>" . $SubCat->getNombre() . "</td>
                        <td>" . $prod->getEstado() . "</td>
                        <td><img src='../Front/Img/" . $prod->getFoto() . "'></td>
                        <td><button class='btnmodProd'
                            data-pic='" . htmlspecialchars($prod->getFoto()) . "'
                            data-id='" . htmlspecialchars($prod->getIDProducto()) . "'
                            data-nombreprod='" . htmlspecialchars($prod->getNombre()) . "'
                            data-color='" . htmlspecialchars($prod->getColor()) . "'
                            data-precio='" . htmlspecialchars($prod->getPrecio()) . "'
                            data-talle='" . htmlspecialchars($prod->getTalle()) . "'
                            data-estado='" . htmlspecialchars($prod->getEstado()) . "'
                            data-subcat='" . htmlspecialchars($SubCat->getNombre()) . "'
                        >Modificar</button></td>
                    </tr>";
            }
        }

        $html .= '</table>';
    } else {
        echo "<script> alert('Ha ocurrido un error grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
    }
    $html .= "</div>";
    return $html;
}
header('Content-Type: application/json');

// Salida en formato JSON
echo json_encode(tabProd());
