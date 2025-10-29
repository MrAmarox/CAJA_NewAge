<?php
include_once '../Logica/Metodos.php';
include_once '../Logica/producto.php';
echo oheader();  // Este ya incluye <html>, <head> y <body>
echo menuhamburguesa();
echo ocart();
echo '
<div class="banner-Socks">
    <div class="contenido-bannerSocks">
    </div>
</div>';



echo '<main style="min-height: 0vh;"></main>';

echo '
<div class="banner-calzacele">
    <div class="contenido-banner">
        <h2 class="txtbanner">Calza Cele <br /> 100% Comodidad</h2>
        <a href="Categoria.php?categoria=4&subcat=5">Comprar ahora</a>
    </div>
</div>';

echo '<main style="min-height: 0vh;"></main>';
echo ofooter(); // </body> & </html>
?>