<?php
    include '../Logica/Metodos.php';
    include '../Logica/productos.php';
    echo oheader();

    echo menuhamburguesa();
 echo '
    <!DOCTYPE html>
    <html lang="es">
     <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Molsy Store</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
            <link rel="stylesheet" href="../Presentacion/DiseñoMolsy.css">
        </head>
    <body>
    <div class="banner-calzacele">
			<div class="contenido-banner">
				<h2 class="txtbanner">Calza Cele <br /> 100% Comodidad</h2>
				<a href="#">Comprar ahora</a>
			</div>
		</div>

        <div class="contenedor-productos">

        </div>

</body>
<main style="min-height: 60vh;">
    </main>';

    if (!isset($_SESSION['producto'])){
     $producto1 = new Producto();
     $producto1->setNombre("C");
     $producto1->setPrecio("Rosita 1");
     $producto1->setColor("Pink");
     $producto1->setTalle("auto1.jpg");
     $_SESSION['Producto'][]= $producto1;

     $producto2 = new Producto();
     $producto2->setNombre("ChatGPT");
     $producto2->setPrecio("Rosita 1");
     $producto2->setColor("Pink");
     $producto2->setTalle("auto1.jpg");
     $_SESSION['Producto'][]= $producto2;

     $producto3 = new Producto();
     $producto3->setNombre("ChatGPT");
     $producto3->setPrecio("Rosita 1");
     $producto3->setColor("Pink");
     $producto3->setTalle("auto1.jpg");
     $_SESSION['Producto'][]= $producto3;
    }

    if(isset($_SESSION['producto']) && !empty($_SESSION('producto'))){
        $productos= [$producto1, $producto2, $producto3];
        echo "<div class='productos-container'>";
        foreach ($productos as $producto) {
            echo "<br>";
            echo "<div class='producto-card'>";
            echo "<img src='Fotos/" . $producto->getFoto() . "'>";
            echo "<h3>" . $vehiculo->getNombre() . " - " . $vehiculo->getPrecio() . "</h3>";
            echo "<p>Color: " . $vehiculo->getColor() . "</p>";
            echo "<p>Talles: " . $vehiculo->getTalle() . "</p>";
            echo "</div>";
        }
        echo "</div>";
           }

    echo ofooter();
?>