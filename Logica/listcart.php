<?php
session_start();
include_once 'producto.php';

function listcart(){
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        $prods = [];
        
        foreach ($_SESSION['carrito'] as $id){
            $resultado = Producto::listarProductos(3, intval($id));
            
            if(!empty($resultado) && is_array($resultado)) {
                $prods[] = $resultado[0]; 
            }
        }
        
        $html = '<div class="cart-items">';
        
        if(!empty($prods)){
            foreach ($prods as $producto) {
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
                                    <label class="visually-hidden">Cantidad: </label>
                                    <button class="qty-button qty-minus" type="button">-</button>
                                    <input class="qty qty-selector product__quantity" type="number" min="1" value="1">
                                    <button class="qty-button qty-plus" type="button">+</button>
                                </cart-product-quantity>
                            </product-quantity>
                            <a class="eliminardelcarrito" href="#" data-idproducto="'. htmlspecialchars($producto->getIDProducto()) .'">Eliminar</a>
                        </div>
                    </div>
                </div>';
            }
        } else {
            $html .= '<p>No hay productos en el carrito</p>';
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