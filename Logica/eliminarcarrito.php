<?php
session_start();

if(isset($_POST['idproducto']) && !empty($_POST['idproducto'])){
    $productoaeliminar = array_search($_POST['idproducto'], $_SESSION['carrito']);
    if($productoaeliminar !== false){
    unset($_SESSION['carrito'][$productoaeliminar]);
    }
}
echo json_encode(['success' => true]);
?>