<?php
    include 'Metodos.php';
    echo oheader();
    echo menuhamburguesa();
    $cat = 'Mujer';
    $incat = $_GET['categoria'] ?? 'Desconocida';
    if ($incat == $cat){
        echo $incat;
    }
?>