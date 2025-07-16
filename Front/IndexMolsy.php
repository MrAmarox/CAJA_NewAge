<?php
    include '../Logica/Metodos.php';
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
				<h2>Calza Cele <br /> 100% Comodidad</h2>
				<a href="#">Comprar ahora</a>
			</div>
		</div>
</body>
<main style="min-height: 60vh;">
    </main>';

    echo ofooter();
?>
