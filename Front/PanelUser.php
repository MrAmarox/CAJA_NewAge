<?php
include_once "../Logica/SubCat.php";
include_once "../Logica/Cat.php";
include_once "../Logica/producto.php";
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
session_start();

if (!isset($_SESSION['usr'])) {
    header("Location: IndexMolsy.php");
    exit;
}

if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: IndexMolsy.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel User</title>
    <link rel="stylesheet" href="DiseñoPanelUser.css">
</head>
<body>
    <div class="logo-container">
        <a href="IndexMolsy.php">
            <img src="Img/logo.png" alt="logo">
        </a>
    </div>

    <?php
    echo "<h1>Bienvenido, " . htmlspecialchars($_SESSION['usr']->getNombre()) . "</h1>";
    ?>

    <div id="tabUsr"></div>

    <!-- Modal -->
    <div id="modalModUsr" class="modal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close">x</span>
                <label>Nombre:</label><br>
                <input type="text" id="nomin" name="nominusr"><br>
                <label>Correo:</label><br>
                <input type="email" id="corrin" name="corrin"><br>
                <label>Contraseña:</label><br>
                <input type="text" id="passin" name="passin"><br>
                <label>Telefono:</label><br>
                <input type="number" id="numin" name="numin"><br>

                <input type="hidden" id="c" name="cii"><br>

                <input type="submit" name="btnmodusr" value="Guardar cambios">
            </form>
        </div>
    </div>

    <form method="post">
        <input type="submit" name="logout" value="Cerrar Sesión" class="cerrarS">
    </form>

    <script>
    // Esperar que cargue el DOM antes de llamar la función
    document.addEventListener("DOMContentLoaded", function() {
        const tdivU = document.getElementById("tabUsr");
        cargarTablaUsuarios(tdivU);
    });

    function cargarTablaUsuarios(tdivU) {
        fetch("../Logica/infUsr.php")
            .then(res => res.json())
            .then(htmlString => {
                tdivU.innerHTML = htmlString;
                tdivU.style.display = "block";
            })
            .catch(error => {
                console.error("Error al obtener la tabla:", error);
            });
    }
    </script>

    <?php
    if (isset($_POST['btnmodusr'])) {
        if (isset($_POST['nominusr']) && isset($_POST['corrin']) && isset($_POST['numin'])) {
            $usr = new Usuario($_POST['cii'], $_POST['nominusr'], $_POST['corrin'], $_POST['numin']);
            $usr->setPass($_POST['passin']);
            Usuario::modUsr($usr); // método ya existente
            $_SESSION['usr'] = $usr; // actualizamos sesión
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    ?>

    <script>
// Abrir y cerrar modal
document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modalModUsr");
    const closeBtn = document.querySelector(".close");

    // Detecta clicks en botones "Modificar" (que vienen en la tabla cargada por fetch)
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains("btnmodUsr")) {
            e.preventDefault();
            modal.style.display = "block";

            // Si querés precargar datos del usuario en el modal
            const fila = e.target.closest("tr");
            document.getElementById("nomin").value = fila.dataset.nombre || "";
            document.getElementById("corrin").value = fila.dataset.correo || "";
            document.getElementById("numin").value = fila.dataset.telefono || "";
            document.getElementById("passin").value = fila.dataset.pass || "";
            document.getElementById("c").value = fila.dataset.ci || "";
        }
    });

    // Cerrar modal con la X
    closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
    });

    // Cerrar modal haciendo clic fuera del contenido
    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    });
});
</script>

</body>
</html>
