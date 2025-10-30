<?php
session_start();
include_once '../Logica/producto.php';
include_once '../Logica/Metodos.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $idProducto = intval($_GET['id']);
    $resultado = Producto::listarProductos(3, $idProducto);

    if(!empty($resultado) && is_array($resultado)){
        $producto = $resultado[0];
    } else {
        header('Location: IndexMolsy.php');
    }
} else {
    header('Location: IndexMolsy.php');
}
echo oheader();
echo ocart();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($producto->getNombre()); ?></title>
</head>

<body>

    <div class="ContDetalles">
        <div class="Imagen-container">
            <img src="Img/<?php echo htmlspecialchars($producto->getFoto()); ?>"
                alt="<?php echo htmlspecialchars($producto->getNombre()); ?>"
                class="Imagen">
        </div>

        <div class="detalle-info">
            <h1><?php echo htmlspecialchars($producto->getNombre()); ?></h1>

            <div class="InfoProd">
                <p><strong>Color:</strong> <?php echo htmlspecialchars($producto->getColor()); ?></p>
                <p><strong>Talle:</strong> <?php echo htmlspecialchars($producto->getTalle()); ?></p>
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

    <script src="Script.js"></script>
</body>

</html>