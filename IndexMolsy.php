<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Molsy Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="DiseñoMolsy.css">
</head>
<body>

    <div class="divEnvio">
        <p>Envíos gratis en Durazno</p>
    </div>

    <header>
        <img class="logo" src="../CAJA_NewAge/Img/logo.png" alt="logo">

        <button id="abrir" class="abrirhamburguesa">
            <i class="bi bi-list"></i>
        </button>

<div class="busqueda">    
    <input type="text" class="buscador" placeholder="Buscar...">
    <button class="buscar"><i class="bi bi-search-heart"></i></button>
 </div>
 <button class="user"> <i class="bi bi-person-heart"></i></button>
 <button class="carrito"> <i class="bi bi-bag-heart"></i></button>

    </header>

    

    <script src="Script.js"></script>
</body>
</html>

<?php

    $cates = array(
        "Mujer"=> array("URL" => "merca", "Calzas" => "rvs", "Pantalones" => "vsd", "Canguros y buzos" => "ar", "Remeras" => "", "Conjuntos" => ""),
        "Hombre"=> array("URL" => "mama", "Pantalones" => "vs<d", "Canguros"=> ""),
        "Accesorios"=> array("URL" => "mame", "Medias" => "sv<es", "Vasos y Botellas" => "", "Accesorios de cabello" => "", "Bolsos" => "")
    );
    echo '<nav id="menuhamburguesa" class="menuhamburguesa">
            <ul class="hamburguesa-list"> ';
            echo '
                <li><button id="cerrar" class="cerrarhamburguesa"><i class="bi bi-x-circle-fill"></i></button></li>
            ';
            foreach ($cates as $cat => $tipo) {
                $ul = array_shift($tipo);
                echo '<li class="itemdemenu"><a href="'.$ul.'">'.$cat.'</a>
                         <ul class="menuvertical">';
                foreach ($tipo as $tipo => $url){
                    echo '<li><a href="'.$url.'">'.$tipo.'</a></li>';
                }
                echo '</ul>
                </li>';
            }
                echo '
                <li><a href="#">Ofertas</a></li>
                <li class="novisi"><a href="#">Cuenta</a></li>
                <li class="novisi"><a href="#">Emprendimiento</a></li>
    ';
    echo '
        </ul>
    </nav>';
?>
