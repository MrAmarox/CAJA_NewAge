<?php
    $cates = array(
        "Mujer"=> array("Calzas", "Pantalones", "Canguros y buzos", "Remeras", "Conjuntos"),
        "Hombre"=> array("Pantalones", "Canguros"),
        "Accesorios"=> array("Medias", "Vasos y Botellas", "Accesorios de cabello", "Bolsos")
    );
    function menuhamburguesa(){
        global $cates; 
        $html = '<nav id="menuhamburguesa" class="menuhamburguesa">
                <ul class="hamburguesa-list">
                    <li><button id="cerrar" class="cerrarhamburguesa"><i class="bi bi-x-circle-fill"></i></button></li>
                ';
                foreach ($cates as $cat => $scat) {
                    $html .= '<li class="itemdemenu"><a href="../Front/Categoria.php?categoria='.$cat.'">'.$cat.'</a>
                             <ul class="menuvertical">';
                    foreach ($scat as $nscat){
                        $html .= '<li><a href="../Front/Categoria.php?categoria='.$cat.'&subcat='.$nscat.'">'.$nscat.'</a></li>';
                    }
                    $html .= '</ul>
                    </li>';
                }
                    $html .= '
                    <li><a href="../Front/Categoria.php?categoria=Ofertas">Ofertas</a></li>
                    <li class="novisi"><a href="#">Cuenta</a></li>
                    <li class="novisi"><a href="#">Emprendimiento</a></li>
        ';
        $html .= '
            </ul>
        </nav>
        <script src="../Front/Script.js"></script>';
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
            <link rel="stylesheet" href="../Front/DiseñoMolsy.css">
        </head>
        <body>
            <div class="divEnvio">
                <p>Envíos gratis en Durazno</p>
            </div>
            <header>
                <a href="IndexMolsy.php"><img class="logo" src="../Img/logo.png" alt="logo"></a>
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
        </body>
        </html>
        ';
        return $html;
    }
    function mosprod($categoria, $subcategoria){
        $bol =false;
        $bol2 =false;
        foreach ($cates as $cat => $scat) {
            
            foreach ($scat as $nscat){
                if($categoria == $cat){
                    if($subcategoria == $nscat){
                        $bol2=true;
                    }
                    $bol=true;
                }
            }
        }
        if($bol=true){
            
            if($bol2=true){
                    
            }
        }
    }
?>