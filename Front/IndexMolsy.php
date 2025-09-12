<?php
include_once '../Logica/Metodos.php';
include_once '../Logica/producto.php';
echo oheader();  // Este ya incluye <html>, <head> y <body>
//echo menuhamburguesa();

echo '
<div class="banner-calzacele">
    <div class="contenido-banner">
        <h2 class="txtbanner">Calza Cele <br /> 100% Comodidad</h2>
        <a href="#">Comprar ahora</a>
    </div>
</div>';

//Cards
echo '
<div class="productos-container">
<div class="producto-card">
    <img src="Img\PolleraLu.jpg">
    <h3> Pollera Lu </h3>
    <p> $390 </p>
    <button class="btn-agregar"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>
</div>';
echo '
<div class="producto-card">
    <img src="Img\ShortVal.jpg">
    <h3> Short Val </h3>
    <p> $320 </p>
    <button class="btn-agregar"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>
</div>';
echo '
<div class="producto-card">
    <img src="Img\ShortBatik.jpg">
    <h3> Short Batik </h3>
    <p> $390 </p>
    <button class="btn-agregar"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>
</div>
</div>';

echo '<main style="min-height: 0vh;"></main>';

echo'
<div class="banner-Socks">
    <div class="contenido-bannerSocks">
        <h2 class="txtbannerSocks"> SOCKS BY MOLSY </h2>
    </div>
</div>';

echo '<main style="min-height: 0vh;"></main>';
echo ofooter(); // </body> & </html>
?>
