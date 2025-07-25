<?php
    include_once "Cat.php";
    $cates= [
        new cat("Mujer",["Calzas", "Pantalones", "Canguros y Buzos", "Remeras", "Conjuntos"], true),
        new cat("Hombre",["Pantalones", "Canguros"], true),
        new cat("Accesorios",["Medias", "Vasos y botellas", "Acccesorios de cabello", "Bolsos"], true)
    ];
    function menuhamburguesa(){
        global $cates;
        $html = '<nav id="menuhamburguesa" class="menuhamburguesa">
                <ul class="hamburguesa-list">
                    <li><button id="cerrar" class="cerrarhamburguesa"><i class="bi bi-x-circle-fill"></i></button></li>
                ';
                foreach ($cates as $cate) {
                    $html .= $cate->html(); 
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
                <a href="IndexMolsy.php"><img class="logo" src="Img/logo.png" alt="logo"></a>
                <button id="abrir" class="abrirhamburguesa">
                    <i class="bi bi-list"></i>
                </button>
                
                <div class="busqueda">
                    <input type="text" class="buscador" placeholder="Buscar...">
                    <button class="buscar"><i class="bi bi-search-heart"></i></button>
                </div>
                
                <a href="Login.php"><button class="user"> <i class="bi bi-person-heart"></i></button></a>
                <button class="carrito"> <i class="bi bi-bag-heart"></i></button>
                
            </header>
        ';
        return $html;
    }

    function ofooter() {
        $html= '
            <footer class="footter">
                <ul class="redes-icon">
                    <li class="icon-elem"><a href="https://www.instagram.com/molsstoredur/" class="icon"><ion-icon name="logo-instagram"></ion-icon></a></li>
                    <li class="icon-elem"><a href="https://www.facebook.com/MolsyStoreDur/" class="icon"><ion-icon name="logo-facebook"></ion-icon></a></li>
                    <li class="icon-elem"><a href="" class="icon"><ion-icon name="logo-whatsapp"></ion-icon></a></li>
                </ul>
        
                <ul class="textos-clink">
                    <li class="txtclink-elementos"><a href="http://localhost/proyecto/Front/IndexMolsy.php" class="menu-icon">Inicio</a></li>
                    <li class="txtclink-elementos"><a href="http://localhost/proyecto/Front/Login.php" class="menu-icon">Cuenta</a></li>
                    <li class="txtclink-elementos"><a href="" class="menu-icon">Contacto</a></li>
                    <li class="txtclink-elementos"><a href="" class="menu-icon">Sobre Nosotros</a></li>
                </ul>
        
                <p class="text">@2025 | Todos los derechos reservados</p>
            </footer>
        
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        </body>
        </html>
        ';
        return $html;
        }


//Si la categoria/subcategoría existe
    function catExis($categoria,$subcategoria){
        $case=0;
        foreach ($cates as $cat => $scat) {
            foreach ($scat as $nscat){
                if($categoria == $cat){
                    if($subcategoria == $nscat){
                        $case=1;
                        exit();
                    }else{
                    $case=2;
                    exit();
                    }
                }
            }
        }
        return $case;
    }

//Mostrar producto
    function mosprod($categoria, $subcategoria){
        switch (catExis($categoria, $subcategoria)){
            case 0:
                echo '<h1 style="text-align:center;">UPS... ESTA CATEGORÍA NO EXISTE</h1>';
                break;
            case 1:
                echo '<h1 style="text-align:center;">mostrar productos</h1>';
                break;
            case 2:
                echo '<h1 style="text-align:center;">UPS... ESTA SUBCATEGORÍA NO EXISTE</h1><br><h1 style="text-align:center;">ESPERE Y SERÁ REDIRIGIDO A LA CATEGORÍA PRINCIPAL.</h1>';
                break;
        }
    }
?>