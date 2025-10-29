<?php
include_once '../Logica/Metodos.php';
echo oheader();
?>
    <div class='producto-container'>
        <div>
            <?php
            
            ?>
        </div>

    </div>

<?php
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        
    }
    echo ofooter();
?>