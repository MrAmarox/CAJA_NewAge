<?php
include '../Logica/Metodos.php';
echo oheader();
echo menuhamburguesa();
?>
<div id="tab"></div>

<?php
echo '<main style="min-height: 20vh;"></main>';
echo ofooter();
?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tablaDiv = document.getElementById("tablaVehiculos");
        const toggleBtn = document.getElementById("toggleTabla");
        cargarTabla();
        var toggl = document.getElementById("btntbl");
        var tdiv = document.getElementById("tab");
        toggl.addEventListener("click", function() {
            if (tdiv.style.display === "none") {
                cargarTabla();
                tdiv.style.display = "block";
                toggl.innerHTML = "OCULTAR VEHICULOS";
            } else {
                tdiv.style.display = "none";
                toggl.innerHTML = "MOSTRAR VEHICULOS";
            }
        });
        const params = new URLSearchParams({
            categoria: categoria,
            subcat: subcategoria
        });

        function cargarTabla() {
            fetch("../Logica/mosProd.php?${params.toString()}")
                .then(res => res.json()) // convierte la respuesta JSON
                .then(htmlString => { // htmlString es un string plano con el contenido HTML
                    tdiv.innerHTML = "";
                    tdiv.innerHTML = htmlString;
                    tdiv.style.display = "block";
                    modal();
                })
                .catch(error => {
                    console.error("Error al obtener la tabla:", error);
                });
        }
    });
</script>