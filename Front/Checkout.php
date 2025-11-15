<?php
include_once '../Logica/Metodos.php';
include_once '../Logica/producto.php';
include_once '../Logica/venta.php';
include_once '../Logica/usuario.php';
echo oheader();
echo ocart();
echo menuhamburguesa();
if (!$_SESSION['usr']) {
    header("Location:IndexMolsy.php");
}
if (isset($_POST['submit'])) {

    if (isset($_POST['pago']) && isset($_POST['check']) && isset($_POST['telefono']) && isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
        $tel = $_POST['telefono'];
        $errores = [];
        if ($_POST['pago'] === 'tarjeta') {
            $numeroTarjeta = $_POST['numero_tarjeta'] ?? '';
            $nombreTarjeta = $_POST['nombre_tarjeta'] ?? '';
            $vencimiento = $_POST['vencimiento'] ?? '';
            $cvv = $_POST['cvv'];
            $pago = 'Pago realizado con tarjeta.';
            if (empty($numeroTarjeta)) {
                $errores[] = "Ingrese el número de tarjeta.";
            }
            if (empty($nombreTarjeta)) {
                $errores[] = "Ingrese el nombre en la tarjeta.";
            }
            if (empty($vencimiento)) {
                $errores[] = "Ingrese la fecha de vencimiento.";
            }
            if (empty($cvv)) {
                $errores[] = "Ingrese el código de seguridad.";
            }
        } elseif ($_POST['pago'] === 'transferencia') {
            $pago = 'Transferencia pendiente.';
        } else {
            $errores[] = "Por favor seleccione un medio de pago.";
        }
        if ($_POST['check'] === "envio") {
            $direccion = $_POST['direcc'] ?? '';
            if (empty($direccion)) {
                $errores[] = 'Ingrese una dirección.';
            }
            $estado = 'Pendiente de entrega';
        } elseif ($_POST['check'] === "retiro") {
            $direccion = 'Retira en sucursal.';
            $estado = 'Pendiente de retiro';
        } else {
            $errores[] = 'Seleccione una opción de entrega';
        }
        if (!empty($errores)) {
            foreach ($errores as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            exit;
        } else {
            $totl = 0;
            foreach ($_SESSION['carrito'] as $idprod => $unid) {
                $prods[$idprod] = $unid;
                $p = Producto::listarProductos(3, intval($idprod));
                $totl += intval($p->getPrecio()) * intval($unid);
            }
            $ci = $_SESSION['usr']->getCedula();
            $venta = new Venta();
            $venta->setCliente($ci);
            $venta->setTel($tel);
            $venta->setPago($pago);
            $venta->setDestino($direccion);
            $venta->setMonto($totl);
            $venta->setProds($prods);
            $venta->setEstado($estado);
            if (Venta::newVenta($venta)) {
                echo "<script>alert('Compra realizada con éxito.');</script>";
                unset($_SESSION['carrito']);
            }
        }
    }
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
                    if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                        $tot = 0;
                        foreach ($_SESSION['carrito'] as $idprod => $unid) {
                            $producto = Producto::listarProductos(3, intval($idprod));
                            echo "
                                <div class='item'>
                                    <img src='../Front/Img/" . $producto->getFoto() . "' alt='" . $producto->getNombre() . "'>
                                    <div class='info'>
                                        <p class='nombre'>" . $producto->getNombre() . "</p>
                                        <p class='precio'>\$" . number_format($producto->getPrecio(), 2) . "</p>
                                        <p class='cantidad'>Cantidad: {$unid}</p>
                                    </div>
                                </div>
                                ";
                            $tot += intval($producto->getPrecio()) * intval($unid);
                        }
                    } else {
                        echo "<p>No hay productos en el carrito.</p>";
                    }
                    ?>
                </div>
                <div class="resumen-total">
                    <p><strong>Total:</strong>
                        <?php
                        echo "\$" . number_format($tot, 2);
                        ?>
                    </p>
                </div>
            </section>

            <!-- Formulario de datos -->
            <section class="datos">
                <h2>Datos</h2>
                <form method="POST" class="checkout-form">
                    <div class="btnes-radio">
                        <input type="radio" class="btn-radioenvio" name="check" value="envio"><span> Envio a domicilio</span>
                        <input type="radio" class="btn-radioretiro" name="check" value='retiro'><span> Retiro en tienda</span>
                    </div>
                    <div id="direccion-container" style="display: none; margin-top: 10px;">
                        <input type="text" id="direccion" name='direcc' placeholder="Ingresá tu dirección">
                    </div>
                    <label>Teléfono</label>
                    <input type="text" name="telefono" required><br>
                    <label>Método de pago</label>
                    <select name="pago" id="metodo-pago" required>
                        <option value="">Selecciona...</option>
                        <option value="transferencia">Transferencia bancaria</option>
                        <option value="tarjeta">Tarjeta de crédito/débito</option>
                    </select><br>

                    <!-- Contenedor dinámico -->
                    <div id="detalles-pago" style="margin-top: 10px;"></div>
                    <button type="submit" class="btn-comprar" name="submit">Confirmar compra</button>
                </form>
            </section>
        </div>
    </div>
</div>
<?php
echo ofooter();
?>
<script>
    const selector = document.getElementById('metodo-pago');
    const contenedor = document.getElementById('detalles-pago');

    selector.addEventListener('change', () => {
        const metodo = selector.value;
        contenedor.innerHTML = ''; // Limpiar contenido anterior

        if (metodo === 'transferencia') {
            contenedor.innerHTML = `<label>Transferí al número de cuenta: <strong> 110710620 - 00001 </strong></label><br><label> ¡Enviá el comprobante a nuestro whatssapp: 099 123 456 789! </label>`;
        } else if (metodo === 'tarjeta') {
            contenedor.innerHTML = `<label>Número de tarjeta</label><br>
                                                        <input type="number" name="numero_tarjeta" maxlength="19" placeholder="XXXX XXXX XXXX XXXX" required><br>
                                                        <label>Nombre en la tarjeta</label><br>
                                                        <input type="text" name="nombre_tarjeta" required><br>

                                                        <label>Fecha de vencimiento</label><br>
                                                        <input type="month" name="vencimiento" maxlength="4" required><br>

                                                        <label>Código de seguridad (CVV)</label><br>
                                                        <input type="text" name="cvv" maxlength="4" required><br>`;
        }
    });
    const radios = document.querySelectorAll('input[name="check"]');
    const direccionContainer = document.getElementById('direccion-container');

    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (radio.value === 'envio') {
                direccionContainer.style.display = 'block';
            } else {
                direccionContainer.style.display = 'none';
            }
        });
    });
</script>