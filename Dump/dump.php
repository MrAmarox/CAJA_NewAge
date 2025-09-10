<?php
#Menu original IndexMolsy.php
/*echo '
                <li class="itemdemenu"><a href="#">Mujer</a>
                    <ul class="menuvertical">
                      <li><a href="#">Calzas</a></li>
                      <li><a href="#">Pantalones</a></li>
                      <li><a href="#">Canguros y buzos</a></li>
                      <li><a href="#">Remeras</a></li>
                     <li><a href="#">Conjuntos</a></li>
                 </ul>
                </li>

                <li class="itemdemenu"><a href="#">Hombre</a>
                    <ul class="menuvertical">
                        <li><a href="#">Pantalones</a></li>
                        <li><a href="#">Canguros y buzos</a></li>
                    </ul>
                </li>

                <li class="itemdemenu"><a href="#">Accesorios</a>
                    <ul class="menuvertical">
                        <li><a href="#">Medias</a></li>
                        <li><a href="#">Vasos y botellas</a></li>
                        <li><a href="#">Accesorios de cabello</a></li>
                        <li><a href="#">Bolsos</a></li>
                    </ul>
                </li>
                ';
                */

/* 
    if(isset($_POST['submit'])){
        $correosRegistrados = array_map(function($usuario) {return strtolower($usuario->getCorreo()); }, $_SESSION['usuarios'] ?? []);
        if (in_array($_POST['correo'], $correosRegistrados)) {
            if($_POST['pass'] == $_POST['pass2']){
                $usuario = new usuario($_POST['correo'],$_POST['pass'],$_POST['ci'],$_POST['nombre'],$_POST['tel']);
                if(!isset($_SESSION['usuarios'])){
                $_SESSION['usuarios'] = [];
                }
                $_SESSION['usuarios'][] = serialize($usuario);

            }else{
                echo '<script>alert("Las contraseñas no coinciden.");</script>';
            }
        }else{
            echo '<script>alert("El correo ingresado ya está registrado.");</script>';

        }
    }*/

    /*switch (catExis($categoria, $subcategoria)) {
        case 0:
            $html= '<h1 style="text-align:center;">UPS... ESTA CATEGORÍA NO EXISTE</h1>';
            break;
        case 1:
                $productos = $_SESSION['Producto'];
                $html= "<div class='productos-container'>";
                foreach ($productos as $producto) {
                    $html .= "<div class='producto-card'>";
                    $html .= "<img src='Img/" . $producto->getFoto() . "' alt='Producto'>";
                    $html .= "<h3>" . $producto->getNombre() . " - " . $producto->getPrecio() . "</h3>";
                    $html .= "<p>Color: " . $producto->getColor() . "</p>";
                    $html .= "<p>Talle: " . $producto->getTalle() . "</p>";
                    $html .= "<button class='btn-agregar'><i class='bi bi-cart-plus'></i> Agregar al carrito</button>";
                    $html .= "</div>";
                }
                $html .= "</div>";
            break;
        case 2:
            $html = '<h1 style="text-align:center;">UPS... ESTA SUBCATEGORÍA NO EXISTE</h1><br><h1 style="text-align:center;">ESPERE Y SERÁ REDIRIGIDO A LA CATEGORÍA PRINCIPAL.</h1>';
            break;
    }*/
?>