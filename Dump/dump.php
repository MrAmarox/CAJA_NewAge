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
?>