<?php
    function menuhamburguesa(){
        $cates = array(
            "Mujer"=> array("Calzas", "Pantalones", "Canguros y buzos", "Remeras", "Conjuntos"),
            "Hombre"=> array("Pantalones", "Canguros"),
            "Accesorios"=> array("Medias", "Vasos y Botellas", "Accesorios de cabello", "Bolsos")
        );
        $html = '<nav id="menuhamburguesa" class="menuhamburguesa">
                <ul class="hamburguesa-list"> ';
                $html .= '
                    <li><button id="cerrar" class="cerrarhamburguesa"><i class="bi bi-x-circle-fill"></i></button></li>
                ';
                foreach ($cates as $cat => $scat) {
                    $html .= '<li class="itemdemenu"><a href="Categoria.php?categoria='.$cat.'">'.$cat.'</a>
                             <ul class="menuvertical">';
                    foreach ($scat as $nscat){
                        $html .= '<li><a href="'.$nscat.'">'.$nscat.'</a></li>';
                    }
                    $html .= '</ul>
                    </li>';
                }
                    $html .= '
                    <li><a href="Categoria.php?categoria=Ofertas">Ofertas</a></li>
                    <li class="novisi"><a href="#">Cuenta</a></li>
                    <li class="novisi"><a href="#">Emprendimiento</a></li>
        ';
        $html .= '
            </ul>
        </nav>';
        return $html;
    }
    function oheader(){
        $html= '
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
        ';
        return $html;
    }
    function productos($categoria, $subcategoría){
        
    }
?>