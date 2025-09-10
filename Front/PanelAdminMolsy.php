<?php
include_once "../Logica/SubCat.php";
include_once "../Logica/Cat.php";
include_once "../Logica/producto.php";
include_once "../Logica/usuario.php";
include_once "../Logica/Metodos.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de admin</title>
    <link rel="stylesheet" href="EstiloPanelAdmin.css">
</head>

<body>
    <div class="logo-container">
        <a href="IndexMolsy.php"> <img src="Img/logo.png" alt="logo"> </a>
    </div>
    <div class="contdiv1">
        <div>
            <h2> Agregar un producto: </h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label> Nombre </label> <input type="text" name="nombreProd">
                <br>
                <label> Precio </label> <input type="number" name="precio">
                <br>
                <label> Color </label> <input type="text" name="color">
                <br>
                <label> Talle </label> <input type="text" name="talle">
                <br>
                <label> Foto </label> <input type="file" name="image">
                <br>
                <label>Visibilidad</label>
                <select id="prodestadoSelect" name="prodestadoSelect">
                    <option value="0">Oculto</option>
                    <option value="1">Visible</option>
                </select>
                <br>
                <label> Subcategoría </label>
                <select id="subcatSelect" name="subcatSelect">

                </select>
                <br>
                <input type="submit" name="agregar">
            </form>
        </div>
        <div>
            <h2>Agregar una SubCategoría: </h2>
            <form action="" method="post">
                <label>Nombre</label> <input type="text" name="nombresubcat">
                <br>
                <label>Estado</label>
                <select id="subestadoSelect" name="subestadoSelect">
                    <option value="0">Inactiva</option>
                    <option value="1">Activa</option>
                </select>
                <label> Categoría </label>
                <select id="catSelect" name="catSelect">

                </select>
                <br>
                <br>
                <input type="submit" name="agregarsubcat">
            </form>
        </div>
        <div>
            <h2>Agregar una Categoría: </h2>
            <form action="" method="post">
                <label>Nombre</label> <input type="text" name="nombrecat">
                <br>
                <label>Estado</label>
                <select id="catestadoSelect" name="catestadoSelect">
                    <option value="0">Inactiva</option>
                    <option value="1">Activa</option>
                </select>
                <br>
                <br>
                <input type="submit" name="agregarcat">
            </form>
        </div>
    </div>
    <div>
        <button id="btntblUsr">OCULTAR USUARIOS</button>
        <div id="tabUsr"></div>
        <button id="btntblProd">OCULTAR PRODUCTOS</button>
        <div id="tabProd"></div>
    </div>

</body>

</html>

<?php
if (isset($_POST['agregar'])) {
    if (isset($_POST['nombreProd']) && isset($_POST['precio']) && isset($_POST['color']) && isset($_POST['talle']) && isset($_POST['subcatSelect']) && isset($_POST['prodestadoSelect'])) {
        $producto = new Producto($_POST['nombreProd'], $_POST['precio'], $_POST['color'], $_POST['talle'], CargarImagen(), $_POST['subcatSelect'], $_POST['prodestadoSelect']);
        $producto->AddProducto();
        echo '<script>cargartablaProds();</script>';
    }
}
if (isset($_POST['agregarsubcat'])) {
    if (isset($_POST['nombresubcat']) && isset($_POST['catSelect']) && isset($_POST['subestadoSelect'])) {

        $Subcat = new SubCat($_POST['nombresubcat'], $_POST['subestadoSelect'], $_POST['catSelect']);
        $Subcat->newSubCat();
    }
}
if (isset($_POST['agregarcat'])) {
    if (isset($_POST['nombrecat']) && isset($_POST['catestadoSelect'])) {
        echo '<script>alert("MATENMEEEE")</script>';
        $cat = new cat($_POST['nombrecat'], $_POST['catestadoSelect']);
        $cat->newCat();
        echo '<script>cargartablaCats();</script>';
    }
}

?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selsub = document.getElementById('subcatSelect');
        var selcat = document.getElementById('catSelect');
        /*selsub.addEventListener('click', function() {
            cargarselectSubcats();
        });
        selcat.addEventListener('click', function() {
            cargarselectCats();
        });*/
        cargarselectCats();
        cargarselectSubcats();
        cargarTablaUsuarios();

        function cargarselectSubcats() {
            fetch('../Logica/getCatSubcatIdNamelist.php?case=1')
                .then(res => res.json()) // convierte la respuesta JSON
                .then(htmlString => { // htmlString es un string plano con el contenido HTML
                    selsub.innerHTML = "";
                    selsub.innerHTML = htmlString;
                })
                .catch(error => {
                    console.error("Error al obtener la tabla:", error);
                });
        }

        function cargarselectCats() {
            fetch('../Logica/getCatSubcatIdNamelist.php?case=2')
                .then(res => res.json()) // convierte la respuesta JSON
                .then(htmlString => { // htmlString es un string plano con el contenido HTML
                    selcat.innerHTML = "";
                    selcat.innerHTML = htmlString;
                })
                .catch(error => {
                    console.error("Error al obtener la tabla:", error);
                });
        }

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        var togglU = document.getElementById("btntblUsr");
        var tdivU = document.getElementById("tabUsr");
        togglU.addEventListener("click", function() {
            if (tdivU.style.display === "none") {
                cargarTablaUsuarios();
                tdivU.style.display = "block";
                togglU.innerHTML = "OCULTAR USUARIOS";
            } else {
                tdivU.style.display = "none";
                togglU.innerHTML = "MOSTRAR USUARIOS";
            }
        });

        function cargarTablaUsuarios() {
            fetch("../Logica/tabUsr.php")
                .then(res => res.json()) // convierte la respuesta JSON
                .then(htmlString => { // htmlString es un string plano con el contenido HTML
                    tdivU.innerHTML = "";
                    tdivU.innerHTML = htmlString;
                    tdivU.style.display = "block";
                })
                .catch(error => {
                    console.error("Error al obtener la tabla:", error);
                });
        }

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        cargarTablaProds();
        var togglP = document.getElementById("btntblProd");
        var tdivP = document.getElementById("tabProd");
        togglP.addEventListener("click", function() {
            if (tdivP.style.display === "none") {
                cargarTablaProds();
                tdivP.style.display = "block";
                togglP.innerHTML = "OCULTAR PRODUCTOS";
            } else {
                tdivP.style.display = "none";
                togglP.innerHTML = "MOSTRAR PRODUCTOS";
            }
        });

        function cargarTablaProds() {
            fetch("../Logica/tabProd.php")
                .then(res => res.json()) // convierte la respuesta JSON
                .then(htmlString => { // htmlString es un string plano con el contenido HTML
                    tdivP.innerHTML = ""
                    tdivP.innerHTML = htmlString
                    tdivP.style.display = "block"
                })
                .catch(error => {
                    console.error("Error al obtener la tabla:", error);
                });
        }
    });
</script>