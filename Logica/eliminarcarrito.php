<?php
session_start();

if(isset($_POST['idproducto']) && !empty($_POST['idproducto'])){
    $idproducto = $_POST['idproducto'];


    if(isset($_SESSION['carrito'][$idproducto])){

        unset($_SESSION['carrito'][$idproducto]);

        echo json_encode([
            'success' => true,
            'message' => 'Producto eliminado',
            'carrito' => $_SESSION['carrito']
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Producto no encontrado en el carrito'
        ]);
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'ID de producto no recibido'
    ]);
}
exit;
?>