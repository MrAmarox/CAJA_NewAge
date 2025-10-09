<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['idproducto']) && !empty($_POST['idproducto'])) {
    $_SESSION['carrito'][] = $_POST['idproducto'];
    
    echo json_encode([
        'success' => true,
        'carrito' => $_SESSION['carrito'],
        'total_items' => count($_SESSION['carrito'])
    ]);
} else {

    echo json_encode([
        'success' => false,
        'message' => 'ID de producto no recibido',
        'post_data' => $_POST,
        'raw_input' => file_get_contents('php://input')
    ]);
}
exit;
?>