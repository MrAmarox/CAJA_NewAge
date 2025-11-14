<?php
include_once 'producto.php';
    function mosprod(){
        $categoria = $_GET['categoria']??'';
        $subcategoria = $_GET['subcat']??'';
            if($categoria==''){
                $prods=Producto::listarProductos(0,0);
            }elseif($categoria!='' && $subcategoria==''){
                $prods=Producto::listarProductos(2,$categoria);
            }else{
                $prods=Producto::listarProductos(1,$subcategoria);
            }

            $html = "<div class='productos-container'>";
            if(!empty($prods)){
                foreach ($prods as $producto) {
                    if($producto->getEstado()===1){
                        $html .= '<div class="producto-card">';
                        $html .= '<a href="Detalles.php?id=' . $producto->getIDProducto() . '" style="text-decoration: none;">';
                        $html .= '<img src="Img/' . $producto->getFoto() . '" alt="Producto">';
                        $html .= '</a>';
                        $html .= '<h3>' . $producto->getNombre() . ' - $' . $producto->getPrecio() . '</h3>';
                        $html .= '<p>Color: ' . $producto->getColor() . '</p>';
                        $html .= '<p>Talle: ' . $producto->getTalle() . '</p>';
                        $html .= '<button class = "btnaggcarrito"
                                data-idproducto="'. htmlspecialchars($producto->getIDProducto()).'"> Agregar al carrito</button>';
                        $html .= "</div>";
                    }
                }
            }else{
                echo "<script> alert('Ha ocurrido un eror grave, será redirigido a la página de inicio. en 10 segundos.'); setTimeout(function() {window.location.href = '../Front/IndexMolsy.php';}, 10000); </script>";
            }
            $html .= "</div>";
        return $html;
    }
    header('Content-Type: application/json');

    // Salida en formato JSON
    echo json_encode(mosprod());
?>