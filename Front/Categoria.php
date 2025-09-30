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
        const tdiv = document.getElementById("tab");
        const urlParams = new URLSearchParams(window.location.search);
        const categoria = urlParams.get("categoria") || "";
        const subcat = urlParams.get("subcat") || "";

        cargarTabla();

        function cargarTabla() {
            if (subcat != "") {
                const params = new URLSearchParams({
                    categoria: categoria,
                    subcat: subcat
                });
                fetch(`../Logica/mosProd.php?${params.toString()}`)
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
            } else if (categoria != "") {
                const params = new URLSearchParams({
                    categoria: categoria
                });
                fetch(`../Logica/mosProd.php?${params.toString()}`)
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
            } else {
                fetch(`../Logica/mosProd.php`)
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
        }
    });
</script>