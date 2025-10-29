<?php
include_once '../Logica/Metodos.php';
echo oheader();
echo ocart();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="DiseñoCheckOut.css">
    <title>Checkuout</title>
</head>
<body>
<div class='producto-container'> 
   <div class="checkout">
    <h1 class="titulocheckout">Finalizar compra</h1>

    <div class="checkout-grid">
        <!-- Resumen del pedido -->
        <section class="resumen">
            <h2>Tu pedido</h2>
            <div class="resumen-items">
                <?php
                if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
                    foreach($_SESSION['carrito'] as $producto){
                        echo "
                        <div class='item'>
                            <img src='{$producto['imagen']}' alt='{$producto['nombre']}'>
                            <div class='info'>
                                <p class='nombre'>{$producto['nombre']}</p>
                                <p class='precio'>\$".number_format($producto['precio'], 2)."</p>
                                <p class='cantidad'>Cantidad: {$producto['cantidad']}</p>
                            </div>
                        </div>
                        ";
                    }
                } else {
                    echo "<p>No hay productos en el carrito.</p>";
                }
                ?>
            </div>
            <div class="resumen-total">
                <p><strong>Total:</strong> 
                <?php
                if(isset($_SESSION['total'])){
                    echo "\$".number_format($_SESSION['total'], 2);
                } else {
                    echo "\$0.00";
                }
                ?>
                </p>
            </div>
        </section>

        <!-- Formulario de datos -->
        <section class="datos">
            <h2>Datos</h2>
            <form action="procesar_compra.php" method="POST" class="checkout-form">
                <div class="btnes-radio"> 
                    <input type="radio" class="btn-radioenvio" name="check"><span>  Envio a domicilio</span>
                    <input type="radio" class="btn-radioretiro" name="check"><span>  Retiro en tienda</span>
                </div>
                <label>Nombre </label>
                <input type="text" name="nombre" required>
<br>
                <label>Email</label>
                <input type="email" name="email" required>
<br>
                <label>Teléfono</label>
                <input type="text" name="telefono" required>
<br>
                <label>Método de pago</label>
                <select name="pago" required>
                    <option value="">Selecciona...</option>
                    <option value="transferencia">Transferencia bancaria</option>
                    <option value="tarjeta">Tarjeta de crédito/débito</option>
                    <option value="efectivo">Efectivo al entregar</option>
                </select>
<br>
                <button type="submit" class="btn-comprar">Confirmar compra</button>
            </form>
        </section>
    </div>
</div>
            </div>
</body>
</html>
<?php
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        
    }
    echo ofooter();
?>