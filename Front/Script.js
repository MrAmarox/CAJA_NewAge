const menuhamburguesa = document.querySelector("#menuhamburguesa");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");

abrir.addEventListener ("click", () => {
    menuhamburguesa.classList.add("visible");
})

cerrar.addEventListener ("click", () => {
    menuhamburguesa.classList.remove("visible");
})