<?php
include_once '../Logica/producto.php';
include_once '../Logica/Metodos.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idProducto = intval($_GET['id']);
    $resultado = Producto::listarProductos(3, $idProducto);

    if (!empty($resultado)) {
        $producto = $resultado;
    } else {
        header('Location: IndexMolsy.php');
        exit;
    }
}
echo oheader();
echo ocart();
echo menuhamburguesa();
?>
    <head>
        <link rel="stylesheet" href="EstiloDetalles.css">
    <title><?php echo htmlspecialchars($producto->getNombre()); ?></title>
    </head>
    <div class="ContDetalles">
        <div class="Imagen-container">
            <img src="Img/<?php echo htmlspecialchars($producto->getFoto()); ?>"
                alt="<?php echo htmlspecialchars($producto->getNombre()); ?>"
                class="Imagen">
        </div>

        <div class="detalle-info">
            <h1><?php echo htmlspecialchars($producto->getNombre()); ?></h1>

            <div class="InfoProd">
                <p class="color"><strong>Color:</strong> <?php echo htmlspecialchars($producto->getColor()); ?></p>
                <p class="talle"><strong>Talle:</strong> <?php echo htmlspecialchars($producto->getTalle()); ?></p>
                <p class="desc"><strong>Descripción:</strong> <?php echo htmlspecialchars($producto->getDesc()); ?></p>
            </div>

            <div class="precio-compra">
                <span class="precio">$<?php echo htmlspecialchars($producto->getPrecio()); ?></span>
                <button class="btnagregarcarrito btnaggcarrito"
                    data-idproducto="<?php echo htmlspecialchars($producto->getIDProducto()); ?>">
                    Agregar al carrito
                </button>
            </div>
        </div>
    </div>

<?php
echo ofooter();
?>