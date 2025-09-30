<?php
    include_once "Cat.php";
    /*$cates= [
        new cat("Mujer",["Calzas", "Pantalones", "Canguros y Buzos", "Remeras", "Conjuntos"], true),
        new cat("Hombre",["Pantalones", "Canguros"], true),
        new cat("Accesorios",["Medias", "Vasos y botellas", "Acccesorios de cabello", "Bolsos"], true)
    ];*/
    function menuhamburguesa(){
        $cates= Cat::bringCats(1);
        $html = '<nav id="menuhamburguesa" class="menuhamburguesa">
                <ul class="hamburguesa-list">
                    <li><button id="cerrar" class="cerrarhamburguesa"><i class="bi bi-x-circle-fill"></i></button></li>
                ';
                foreach ($cates as $cate) {
                    $html .= $cate->menHam(); 
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
                    <li class="txtclink-elementos"><a href="C:\Users\56846014\Documents\GitHub\CAJA_NewAge\Front\Nosotros.php" class="menu-icon">Sobre Nosotros</a></li>
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


    function CargarImagen(){
        if (isset($_FILES['image'])) {
            // Obtener detalles del archivo
            $RutaTemporal = $_FILES['image']['tmp_name']; // Esta línea obtiene la ruta temporal donde se almacena el archivo subido en el servidor de forma temporal.
            $NombreDelArchivo = $_FILES['image']['name']; // Aquí se obtiene el nombre original del archivo subido, tal como aparece en el dispositivo del usuario.
            $NombreDelArchivoCmps = explode(separator: ".", string: $NombreDelArchivo); // Función explode: Esta función toma una cadena de texto y la divide en partes basándose en un delimitador, en este caso el punto (.). Propósito: El objetivo es dividir el nombre del archivo en dos partes: el nombre base y la extensión. Ejemplo Si el archivo es foto_vacaciones.jpg, después de aplicar explode(".", $NombreDelArchivo), el resultado será un array: $NombreDelArchivoCmps = ['foto_vacaciones', 'jpg'];
            $ExtensionDelArchivo = strtolower(end($NombreDelArchivoCmps));
            $extensionesPErmitidas = array('jpg', 'gif', 'png', 'jpeg'); // Definir extensiones permitidas
            if (in_array(needle: $ExtensionDelArchivo, haystack: $extensionesPErmitidas)) { // in_array(), comprueba si un elemento existe dentro de un array.
                $DirectorioDestino = '../Front/Img/';
                $RutaCompetaFinal = $DirectorioDestino . $NombreDelArchivo; // Establecer el directorio donde se guardará la imagen
                if (move_uploaded_file(from: $RutaTemporal, to: $RutaCompetaFinal)) { // Mover el archivo subido a la carpeta de destino
                    //echo "El archivo fue guardado correctamente";
                    return $NombreDelArchivo;
                } else {
                    echo "Hubo un error moviendo el archivo a la carpeta de destino.";
                    return null;
                }
            } else {
                echo "Tipo de archivo no permitido. Solo se permiten imágenes en formato JPG, PNG, GIF, JPEG.";
                return null;
            }
        } else {
            echo "Hubo un error al subir el archivo (input).";
            return null;
        }
    }

?>