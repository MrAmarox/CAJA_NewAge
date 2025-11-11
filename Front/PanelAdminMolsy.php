<?php
    include_once "../Logica/SubCat.php";
    include_once "../Logica/Cat.php";
    include_once "../Logica/producto.php";
    include_once "../Logica/usuario.php";
    include_once "../Logica/Metodos.php";
    session_start();
    if ($_SESSION['usr']) {
        if ($_SESSION['usr']->getTipo() !== 2 && $_SESSION['usr']->getTipo() !== 0) {
            header("Location:IndexMolsy.php");
        }
    } else {
        header("Location:IndexMolsy.php");
    }

    if (isset($_POST['agregar'])) {
        if (isset($_POST['nombreProd']) && isset($_POST['precio']) && isset($_POST['color']) && isset($_POST['talle']) && isset($_POST['subcatSelect']) && isset($_POST['prodestadoSelect']) && isset($_POST['stockin'])) {
            if ($_POST['stockin'] <= 1 || !isset($_POST['stickin'])) {
                $stock = 1;
            } else {
                $stock = $_POST['stockin'];
            }
            $producto = new Producto($_POST['nombreProd'], $_POST['precio'], $_POST['color'], $_POST['talle'], CargarImagen(), $_POST['subcatSelect'], $_POST['prodestadoSelect']);
            $producto->setStock($_POST['stockin']);
            $producto->setDesc($_POST['descr']);
            $producto->AddProducto();
            unset($_FILES['image']);
            header("Location: " . $_SERVER['PHP_SELF']);
            echo '<script>cargartablaProds();</script>';
        }
    }
    if (isset($_POST['agregarsubcat'])) {
        if (isset($_POST['nombresubcat']) && isset($_POST['catSelect']) && isset($_POST['subestadoSelect'])) {
            $Subcat = new SubCat($_POST['nombresubcat'], $_POST['subestadoSelect'], $_POST['catSelect']);
            $Subcat->newSubCat();
            header("Location: " . $_SERVER['PHP_SELF']);
            echo '<script>cargarselectSubcats();</script>';
        }
    }
    if (isset($_POST['agregarcat'])) {
        if (isset($_POST['nombrecat']) && isset($_POST['catestadoSelect'])) {
            $cat = new cat($_POST['nombrecat'], $_POST['catestadoSelect']);
            $cat->newCat();
            header("Location: " . $_SERVER['PHP_SELF']);
            echo '<script>cargarselectCats();</script>';
        }
    }
    if (isset($_POST['btnmodusr'])) {
        if (isset($_POST['nominusr']) && isset($_POST['numin']) && isset($_POST['corrin'])) {
            $usr = new usuario($_POST['cii'], $_POST['nominusr'], $_POST['corrin'], $_POST['numin']);
            if (isset($_POST['tipoSelect'])) {
                $usr->setTipo($_POST['tipoSelect']);
            } else {
                $usr->setTipo($_POST['typ']);
            }
            if (Usuario::modUsr($usr)) {
                echo '<script>alert("Usuario modificado con exito");</script>';
            } else {
                echo '<script>alert("Error al modificar el usuario");</script>';
            }
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    }
    if (isset($_POST['btnmodProd'])) {
        if (isset($_POST['nominp']) && isset($_POST['colin']) && isset($_POST['estSelect']) && isset($_POST['tallin'])) {
            if (isset($_FILES['image2']) && $_FILES['image2']['error'] !== UPLOAD_ERR_NO_FILE) {
                $prod = new Producto($_POST['nominp'], $_POST['numinp'], $_POST['colin'], $_POST['tallin'], CargarImagen(), $_POST['subcatIDmod'], $_POST['estSelect']);
            } else {
                $prod = new Producto($_POST['nominp'], $_POST['numinp'], $_POST['colin'], $_POST['tallin'], $_POST['oldpic'], $_POST['subcatIDmod'], $_POST['estSelect']);
            }
            $prod->setStock($_POST['stocking']);
            $prod->setDesc($_POST['descrin']);
            unset($_FILES['image2']);
            $prod->setIDProducto($_POST['id']);
            if (Producto::modProd($prod)) {
                echo '<script>alert("Producto modificado con exito");</script>';
            } else {
                echo '<script>alert("Error al modificar el producto");</script>';
            }
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    }

    if (isset($_POST['eliminarcat'])) {
        if (Cat::delCat($_POST['catselecte'])) {
            echo '<script>alert("Categoría eliminada con exito");</script>';
        } else {
            echo '<script>alert("Error al eliminar categoría, elimine todas las subcategorías dependientes e intente nuevamente.");</script>';
        }
    }

    if (isset($_POST['eliminarsubcat'])) {
        if (SubCat::delSubcat($_POST['subcatselecte'])) {
            echo '<script>alert("Subcategoría eliminada con exito");</script>';
        } else {
            echo '<script>alert("Error al eliminar subcategoría.");</script>';
        }
    }
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

                    </select><br>
                    <label>Stock</label> <input type="number" name="stockin">
                    <br>
                    <label>Descripción</label><textarea name="descr"></textarea><br>
                    <input type="submit" name="agregar" value="Agregar">
                </form>
            </div>
        </div>
        <div>
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
                    <input type="submit" name="agregarsubcat" value="Agregar">
                </form>
            </div>
            <div>
                <h2>Eliminar una Subcategoría: </h2>
                <form action="" method="post">
                    <select id="subcatSelecte" name="subcatselecte">

                    </select>
                    <br>
                    <input type="submit" name="eliminarsubcat" value="Eliminar">
                </form>
            </div>

        </div>
        <div>
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
                    <input type="submit" name="agregarcat" value="Agregar">
                </form>
            </div>
            <div>
                <h2>Eliminar una Categoría: </h2>
                <form action="" method="post">
                    <select id="catSelecte" name="catselecte">

                    </select>
                    <br>
                    <input type="submit" name="eliminarcat" value="Eliminar">
                </form>
            </div>

        </div>
    </div>

    <center>
        <button class="btnblUsr" id="btntblUsr">OCULTAR USUARIOS</button>
        <button class="btntblProd" id="btntblProd">OCULTAR PRODUCTOS</button>
    </center>

    <!--TABLAS USUARIO Y PRODUCTO -->
    <div id="tabUsr"></div>
    <div id="tabProd"></div>


    <!--Modal USUARIO -->
    <div id="modalModUsr" class="modal">
        <div class="modal-content">
            <form action="" method="post">
                <span class="close">x</span>
                <label>Nombre: </label><label id="nombreUsr"></label><br>
                <input type="text" id="nomin" name="nominusr"><br>
                <label>CI: </label><label id="ci"></label><input type="hidden" id="c" name="cii"><br>
                <label>Correo: </label><label id="corr"></label><br>
                <input type="email" id="corrin" name="corrin"><br>
                <label>Telefono: </label><label id="telefono"></label><br>
                <input type="number" id="numin" name="numin"><br>
                <label>Tipo: </label><label id="tipo"></label>
                <?php
                if ($_SESSION['usr']->getTipo() === 0) {
                    echo '
                        <select class="tipoSelect" id="tipoSelect" name="tipoSelect">
                            <option value="0">Admin</option>
                            <option value="1">Cliente</option>
                            <option value="2">Empleado</option>
                        </select><br>';
                } else {
                    echo '<input type="hidden" id="typ" name="typ"><br><script>document.getElementById("typ").value = this.dataset.tipo;</script>';
                }
                ?>
                <input type="submit" name="btnmodusr" value="Modificar">
            </form>
        </div>
    </div>

    <!--Modal PRODUCTO -->
    <div id="modalModProd" class="modal">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data">
                <span class="closep">x</span>
                <img id="foto" src="">
<<<<<<< Updated upstream
                <label>Foto: </label><input type='hidden' id="fotoProd" name="oldpic"></label><br>
                <label>Nombre: </label><label id="nombreProd"></label>
                <input type="text" id="nominp" name="nominp"><br>
                <label>Subcategoría: </label><label id="subcatIDmod"></label><input type=hidden name=subcatIDmod id=subcatIDmodin><br>
                <label>Precio: </label><label id="prec"></label>
                <input type="text" id="numinp" name="numinp"><br>
                <label>ID: </label><label id="id"></label><input type="hidden" id="idin" name="id"><br>
                <label>Color: </label><label id="col"></label>
                <input type="text" id="colin" name="colin"><br>
                <label>Talle: </label><label id="talle"></label>
                <input type="text" id="tallin" name="tallin"><br>
<<<<<<< Updated upstream
                <Label>Nueva Foto:</Label> <input type="file" name="image2"><br>
                <label>Visibilidad: </label><label id="estado"></label>
                <select id="estSelect" name="estSelect">
                    <option value="0">Oculto</option>
                    <option value="1">Visible</option>
                </select><br>
                <label>Stock: </label><label id="stock"></label><input type="number" id="stockn" name="stocking"><br>
                <label>Descripción:</label>
                <textarea name="descrin" id="descrin"></textarea><br>
                <input type="submit" name="btnmodProd" value="Modificar">
            </form>
        </div>
    </div>

</body>

</html>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var selsub = document.getElementById('subcatSelect');
        var selsube = document.getElementById('subcatSelecte');
        var selcat = document.getElementById('catSelect');
        var selcate = document.getElementById('catSelecte');
        cargarselectCats();
        cargarselectSubcats();
        cargarTablaUsuarios();
        modalUsr();

        function cargarselectSubcats() {
            fetch('../Logica/getCatSubcatIdNamelist.php?case=1')
                .then(res => res.json()) // convierte la respuesta JSON
                .then(htmlString => { // htmlString es un string plano con el contenido HTML
                    selsub.innerHTML = "";
                    selsub.innerHTML = htmlString;
                    selsube.innerHTML = "";
                    selsube.innerHTML = htmlString;
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
                    selcate.innerHTML = "";
                    selcate.innerHTML = htmlString;
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
                    modalUsr();
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
                    modalProd();
                })
                .catch(error => {
                    console.error("Error al obtener la tabla:", error);
                });
        }

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        function modalUsr() {
            var modal = document.getElementById("modalModUsr");
            var btn = document.getElementById("btnmodUsr");
            var span = document.getElementsByClassName("close")[0];
            modal.style.display = 'none';
            document.querySelectorAll('.btnmodUsr').forEach(button => {
                button.addEventListener('click', function() {
                    const modal = document.getElementById("modalModUsr");
                    modal.style.display = "block"; // Populate modal fields
                    document.getElementById('nombreUsr').innerHTML = this.dataset.nombreusr;
                    document.getElementById('nomin').value = this.dataset.nombreusr;
                    document.getElementById('ci').innerHTML = this.dataset.ci;
                    document.getElementById('c').value = this.dataset.ci;
                    document.getElementById('corr').innerHTML = this.dataset.corr;
                    document.getElementById('corrin').value = this.dataset.corr;
                    document.getElementById('telefono').innerHTML = this.dataset.tel;
                    document.getElementById('numin').value = this.dataset.tel;
                    document.getElementById('tipo').innerHTML = this.dataset.tipo;
                    document.getElementById('foto').src = this.dataset.foto;
                });
            });
            span.onclick = function() {
                modal.style.display = "none";
            };
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };

        }

        /*------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        /**/
        function modalProd() {
            var modalp = document.getElementById("modalModProd");
            var btn = document.getElementById("btnmodProd");
            var spanp = document.getElementsByClassName("closep")[0];
            modalp.style.display = 'none';
            document.querySelectorAll('.btnmodProd').forEach(button => {
                button.addEventListener('click', function() {
                    const modalp = document.getElementById("modalModProd");
                    modalp.style.display = "block"; // Populate modal fields
                    document.getElementById('nombreProd').innerHTML = this.dataset.nombreprod;
                    document.getElementById('nominp').value = this.dataset.nombreprod;
                    document.getElementById('id').innerHTML = this.dataset.id;
                    document.getElementById('idin').value = this.dataset.id;
                    document.getElementById('col').innerHTML = this.dataset.color;
                    document.getElementById('colin').value = this.dataset.color;
                    document.getElementById('talle').innerHTML = this.dataset.talle;
                    document.getElementById('tallin').value = this.dataset.talle;
                    document.getElementById('estado').innerHTML = this.dataset.estado;
                    document.getElementById('prec').innerHTML = this.dataset.precio;
                    document.getElementById('numinp').value = this.dataset.precio;
                    document.getElementById('subcatIDmod').innerHTML = this.dataset.subcat;
                    document.getElementById('subcatIDmodin').value = this.dataset.subcat;
                    document.getElementById('fotoProd').value = this.dataset.pic;
                    document.getElementById('stock').innerHTML = this.dataset.stock;
                    document.getElementById('stockn').value = this.dataset.stock;
                    //document.getElementById('desc').innerHTML = this.dataset.desc;
                    document.getElementById('descrin').value = this.dataset.desc;
                });
            });
            spanp.onclick = function() {
                modalp.style.display = "none";
            };
            window.onclick = function(event) {
<<<<<<< Updated upstream
                if (event.target == modalp) {
                    modalp.style.display = "none";
                }
            };

        }
    });
</script>