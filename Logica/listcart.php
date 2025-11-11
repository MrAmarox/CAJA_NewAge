<?php
session_start();
include_once 'producto.php';

function listcart(){
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){

         $html = '<div class="cart-items">';

        foreach ($_SESSION['carrito'] as $id => $cantidad){
            $producto = Producto::listarProductos(3, intval($id));
            $html .='<div class="cart-item">
                <a class="thumbnail" href="#">
                    <figure class="lazy-image-small">
                        <img class="product-thumb" src="../Front/Img/'. htmlspecialchars($producto->getFoto()) .'">
                    </figure>
                </a>
                <div class="content">
                    <p class="item-title">'. htmlspecialchars($producto->getNombre()) .'</p>
                    <div class="item-price text-size--smaller"><strong>$'. htmlspecialchars($producto->getPrecio()) .'</strong></div>
                    <div class="actions">
                        <product-quantity class="quantity-selector-holder">
                            <cart-product-quantity>
                                <label class="cantidad">Cantidad: </label>
                                <button class="qty-button qty-minus" type="button" data-idproducto="'. htmlspecialchars($producto->getIDProducto()) .'">-</button>
                                <input class="qty qty-selector product__quantity" type="number" min="1" value="'. htmlspecialchars(($cantidad)) .'" readonly>
                                <button class="qty-button qty-plus" type="button" data-idproducto="'. htmlspecialchars($producto->getIDProducto()) .'">+</button>
                            </cart-product-quantity>
                        </product-quantity>
                        <a class="eliminardelcarrito" href="#" data-idproducto="'. htmlspecialchars($producto->getIDProducto()) .'">Eliminar</a>
                    </div>
                </div>
            </div>';
        }
        $html .= '</div>';

        return ['success' => true, 'html' => $html];

    } else {
        return ['success' => true, 'html' => '<p>El carrito está vacío</p>'];
    }
}
header('Content-Type: application/json');
echo json_encode(listcart());
?>