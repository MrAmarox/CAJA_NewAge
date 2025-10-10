<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['idproducto']) && !empty($_POST['idproducto'])) {
    $idproducto = $_POST['idproducto'];
    $accion = $_POST['accion'] ?? 'agregar';

    if (in_array($accion, ['agregar', 'incrementar'])) {
        if(isset($_SESSION['carrito'][$idproducto])){
            $_SESSION['carrito'][$idproducto]++;
        } else {
            $_SESSION['carrito'][$idproducto] = 1;
        }

    } elseif ($accion == 'decrementar') {
        if(isset($_SESSION['carrito'][$idproducto])){
            $_SESSION['carrito'][$idproducto]--;
            if($_SESSION['carrito'][$idproducto] <= 0){
                unset($_SESSION['carrito'][$idproducto]);
            }
        }
    }
    echo json_encode([
        'success' => true,
        'carrito' => $_SESSION['carrito'],
        'total_items' => count($_SESSION['carrito'])
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'ID de producto no recibido'
    ]);
}
exit;
?>