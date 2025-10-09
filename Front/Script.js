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
document.addEventListener('click', function(e) {
    if(e.target && e.target.classList.contains('btnaggcarrito')) {
        e.preventDefault();
        e.stopPropagation();
        
        const idProducto = e.target.getAttribute('data-idproducto');
        console.log('ID Producto:', idProducto);
        
        // Agregar producto al carrito
        fetch('../logica/agregarcarrito.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'idproducto=' + encodeURIComponent(idProducto)
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert('Producto agregado al carrito');
                
                // Si el carrito está abierto, actualizarlo
                const cartElement = document.getElementById("myCart");
                if(cartElement && cartElement.style.width === "500px") {
                    cargarProductosCarrito();
                }
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error al agregar:', error);
            alert('Error al agregar el producto');
        });
    }
});

// Función para abrir el carrito
function openCart() {
    const cartElement = document.getElementById("myCart");
    if(cartElement) {
        cartElement.style.width = "600px";
        cargarProductosCarrito();
    }
}

// Función para cargar los productos del carrito
function cargarProductosCarrito() {
    console.log('Cargando productos del carrito...');
    
    fetch('../Logica/listcart.php')
        .then(res => res.json())
        .then(data => {
            console.log('Datos del carrito:', data);
            if(data.success) {
                const contenedorCarrito = document.getElementById('cart-content');
                if(contenedorCarrito) {
                    contenedorCarrito.innerHTML = data.html;
                    console.log('Carrito actualizado');
                } else {
                    console.error('No se encontró el elemento #cart-content');
                }
            }
        })
        .catch(error => {
            console.error('Error al cargar carrito:', error);
        });
}

// Función para cerrar el carrito
function closeCart() {
    const cartElement = document.getElementById("myCart");
    if(cartElement) {
        cartElement.style.width = "0";
    }
}
