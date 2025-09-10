<?php
include_once '../Logica/Metodos.php';
include_once '../Logica/producto.php';
echo oheader();  // Este ya incluye <html>, <head> y <body>
echo menuhamburguesa();

echo '
<div class="banner-calzacele">
    <div class="contenido-banner">
        <h2 class="txtbanner">Calza Cele <br /> 100% Comodidad</h2>
        <a href="#">Comprar ahora</a>
    </div>
</div>';


echo'
<div class="banner-Socks">
    <div class="contenido-bannerSocks">
        <h2 class="txtbannerSocks"> SOCKS BY MOLSY </h2>
    </div>
</div>';

echo '<main style="min-height: 20vh;"></main>';
echo ofooter(); // </body> & </html>
?>
