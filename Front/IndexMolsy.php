<?php
include '../Logica/Metodos.php';
include '../Logica/productos.php';
echo oheader();  // Este ya incluye <html>, <head> y <body>
echo menuhamburguesa();

echo '
<div class="banner-calzacele">
    <div class="contenido-banner">
        <h2 class="txtbanner">Calza Cele <br /> 100% Comodidad</h2>
        <a href="#">Comprar ahora</a>
    </div>
</div>';

if (!isset($_SESSION['Producto'])) {
    $producto1 = new Producto();
    $producto1->setNombre("Calza Batik");
    $producto1->setPrecio("$590");
    $producto1->setColor("Negro");
    $producto1->setTalle("M / L ");
    $producto1->setFoto("CalzaBatikN.jpg");
    $_SESSION['Producto'][]= $producto1;

    $producto2 = new Producto();
    $producto2->setNombre("Calza Print");
    $producto2->setPrecio("$590");
    $producto2->setColor("Marron");
    $producto2->setTalle("S / M");
    $producto2->setFoto("CalzaPrintM.jpg");
    $_SESSION['Producto'][]= $producto2;

    $producto3 = new Producto();
    $producto3->setNombre("Calza Batik");
    $producto3->setPrecio("$590");
    $producto3->setColor("Rosa");
    $producto3->setTalle("M / L");
    $producto3->setFoto("CalzaBatikR.jpg");
    $_SESSION['Producto'][]= $producto3;
}

if (isset($_SESSION['Producto']) && !empty($_SESSION['Producto'])) {
    $productos = $_SESSION['Producto'];
    echo "<div class='productos-container'>";
    foreach ($productos as $producto) {
        echo "<div class='producto-card'>";
        echo "<img src='Img/" . $producto->getFoto() . "' alt='Producto'>";
        echo "<h3>" . $producto->getNombre() . " - " . $producto->getPrecio() . "</h3>";
        echo "<p>Color: " . $producto->getColor() . "</p>";
        echo "<p>Talle: " . $producto->getTalle() . "</p>";
        echo "<button class='btn-agregar'><i class='bi bi-cart-plus'></i> Agregar al carrito</button>";
        echo "</div>";
    }
    echo "</div>";
}
echo'
<div class="banner-Socks">
    <div class="contenido-bannerSocks">
        <h2 class="txtbannerSocks"> SOCKS BY MOLSY </h2>
    </div>
</div>';

echo '<main style="min-height: 20vh;"></main>';
echo ofooter();
?>
