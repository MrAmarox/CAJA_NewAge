<?php
    include_once '../Logica/Metodos.php';
    include_once '../Logica/producto.php';
    echo oheader();
    echo ocart();
    echo menuhamburguesa();
    if (!$_SESSION['usr']) {
        header("Location:IndexMolsy.php");
    }
?>

<title>Checkout</title>
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
                            $tot=0;
                            foreach($_SESSION['carrito'] as $idprod => $unid){
                                $producto=Producto::listarProductos(3,intval($idprod));
                                echo "
                                <div class='item'>
                                    <img src='../Front/Img/".$producto->getFoto()."' alt='".$producto->getNombre()."'>
                                    <div class='info'>
                                        <p class='nombre'>".$producto->getNombre()."</p>
                                        <p class='precio'>\$".number_format($producto->getPrecio(), 2)."</p>
                                        <p class='cantidad'>Cantidad: {$unid}</p>
                                    </div>
                                </div>
                                ";
                                $tot+=intval($producto->getPrecio())*intval($unid);
                            }
                        } else {
                            echo "<p>No hay productos en el carrito.</p>";
                        }
                        ?>
                    </div>
                    <div class="resumen-total">
                        <p><strong>Total:</strong> 
                        <?php
                            echo "\$".number_format($tot, 2);
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
                        <!--<label>Nombre </label>
                        <input type="text" name="nombre" required><br>
                        <label>Email</label>
                        <input type="email" name="email" required><br>-->
                        <label>Teléfono</label>
                        <input type="text" name="telefono" required><br>
                        <label>Método de pago</label>
                        <select name="pago" required>
                            <option value="">Selecciona...</option>
                            <option value="transferencia">Transferencia bancaria</option>
                            <option value="tarjeta">Tarjeta de crédito/débito</option>
                            <option value="efectivo">Efectivo</option>
                        </select><br>
                        <button type="submit" class="btn-comprar">Confirmar compra</button>
                    </form>
                </section>
            </div>
        </div>
    </div>
<?php
    echo ofooter();
?>