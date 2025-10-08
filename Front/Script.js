const menuhamburguesa = document.querySelector("#menuhamburguesa");
const abrir = document.querySelector("#abrir");
const cerrar = document.querySelector("#cerrar");

abrir.addEventListener ("click", () => {
    menuhamburguesa.classList.add("visible");
})

cerrar.addEventListener ("click", () => {
    menuhamburguesa.classList.remove("visible");
})

/*--------------------Carrito-----------------*/
function openCart() {
    document.getElementById("myCart").style.width = "500px"; 
}

function closeCart() {
    document.getElementById("myCart").style.width = "0";
}

//eventlistener para el boton q agregue el id al arrat y el fetch trae los productos del carrito para mostrarlos 