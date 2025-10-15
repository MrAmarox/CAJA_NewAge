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
    echo "<h1>Bienvenido/a, " . htmlspecialchars($_SESSION['usr']->getNombre()) . "</h1>";
    ?>

    <div id="tabUsr"></div>
    <center>
        <button class="btnmodUsr">Modificar</button>
        <button class="btnmodPass">Cambiar contraseña</button>
    </center>

    <!-- Modal -->
    <div id="modalModUsr" class="modal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close">x</span>
                <label>Nombre:</label><br>
                <input type="text" id="nomin" name="nominusr" required><br>
                <label>Correo:</label><br>
                <input type="email" id="corrin" name="corrin" required><br>
                <label>Telefono:</label><br>
                <input type="number" id="numin" name="numin" required><br>

                <input type="hidden" id="ciiu" name="ciiu"><br>

                <input type="submit" name="btnmodusr" value="Guardar cambios">
            </form>
        </div>
    </div>
    <div id="modalModPass" class="modal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="closep">x</span>
                <label>Contraseña actual:</label><br>
                <input type="password" id="cpass" name="cpass" required><br>
                <label>Nueva contraseña:</label><br>
                <input type="password" id="npass" name="npass" required><br>
                <label>Confirmar contraseña:</label><br>
                <input type="password" id="npass2" name="npass2" required><br>
                <input type="hidden" id="ciip" name="ciip"><br>
                <input type="submit" name="btnmodpass" value="Cambiar contraseña">
            </form>
        </div>
    </div>

    <form method="post">
        <input type="submit" name="logout" value="Cerrar Sesión" class="cerrarS">
    </form>


    <?php
    if (isset($_POST['btnmodusr'])) {
        if (isset($_POST['nominusr']) && isset($_POST['corrin']) && isset($_POST['numin'])) {
            $usr = new Usuario($_POST['ciiu'], $_POST['nominusr'], $_POST['corrin'], $_POST['numin']);
            if(Usuario::modUsr($usr)){
                $_SESSION['usr'] = Usuario::getUsrWCI($_POST['ciiu']); // actualizamos sesión
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }else{
                echo '<script>alert("Error al modificar el usuario, intente nuevamente.")</script>';
            }
        }
    }
    if (isset($_POST['btnmodpass'])) {
        if (isset($_POST['cpass']) && isset($_POST['npass']) && isset($_POST['npass2'])) {
            if(Usuario::checkPass($_POST['ciip'],$_POST['cpass'])){
                if ($_POST['npass'] === $_POST['npass2']) {
                    if(Usuario::modPass($_POST['npass'], $_POST['ciip'])){
                        header("Location: " . $_SERVER['PHP_SELF']);
                        exit;
                    }else{
                        echo '<script>alert("Error al modificar la contraseña, intente nuevamente.")</script>';
                    }
                }else{
                    echo '<script>alert("Las contraseñas no coinciden.");</script>';
                }
            }else{
                echo '<script>alert("La contraseña actual no es correcta.");</script>';
            }
        }else{
            echo '<script>alert("Todos los campos son requeridos.");</script>';
        }
    }

    if (isset($_POST['logout'])) {
        unset($_SESSION['usr']);
        header("location: " . "../Front/IndexMolsy.php");
    }
    ?>

    <script>
        // Esperar que cargue el DOM antes de llamar la función
        document.addEventListener("DOMContentLoaded", function() {
            const tdivU = document.getElementById("tabUsr");
            cargarTablaUsuarios(tdivU);


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
            /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
            // Abrir y cerrar modal modUsr

            const modal = document.getElementById("modalModUsr");
            const closeBtn = document.querySelector(".close");

            // Detecta clicks en boton 'modificar'
            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("btnmodUsr")) {
                    e.preventDefault();
                    modal.style.display = "block";

                    const fila = document.querySelector(".tabla-usuarios tr:nth-child(2)"); // la primera fila de datos
                    const nombre = fila.querySelector("td[data-nombreusr]").dataset.nombreusr;
                    const ci = fila.querySelector("td[data-ci]").dataset.ci;
                    const tel = fila.querySelector("td[data-tel]").dataset.tel;
                    const corr = fila.querySelector("td[data-corr]").dataset.corr;

                    // Cargar los datos en el modal
                    document.getElementById("nomin").value = nombre || "";
                    document.getElementById("ciiu").value = ci || "";
                    document.getElementById("numin").value = tel || "";
                    document.getElementById("corrin").value = corr || "";
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

            /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

            // Abrir y cerrar modal modPass
            const modalp = document.getElementById("modalModPass");
            const closeBtnp = document.querySelector(".closep");

            // Detecta clicks en boton "cambiar contraseña"
            document.addEventListener("click", function(e) {
                if (e.target.classList.contains("btnmodPass")) {
                    e.preventDefault();
                    const fila = document.querySelector(".tabla-usuarios tr:nth-child(2)");
                    const ci = fila.querySelector("td[data-ci]").dataset.ci;
                    modalp.style.display = "block";
                    document.getElementById("ciip").value = ci || "";
                }
            });

            // Cerrar modal con la X
            closeBtnp.addEventListener("click", () => {
                modalp.style.display = "none";
            });

            // Cerrar modal haciendo clic fuera del contenido
            window.addEventListener("click", (e) => {
                if (e.target === modalp) {
                    modalp.style.display = "none";
                }
            });
        });
    </script>

</body>

</html>