<?php
    include '../Logica/Metodos.php';
    echo oheader();
    echo menuhamburguesa();
    $cat = 'Mujer';
    $incat = $_GET['categoria'] ?? 'Desconocida';
    $insubcat = $_GET['subcat'];
    if($incat != null){
        if ($incat == $cat){
            echo $incat;
        }
    }
?>