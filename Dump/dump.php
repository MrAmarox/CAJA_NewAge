<?php
#Menu original IndexMolsy.php
/*echo '
                <li class="itemdemenu"><a href="#">Mujer</a>
                    <ul class="menuvertical">
                      <li><a href="#">Calzas</a></li>
                      <li><a href="#">Pantalones</a></li>
                      <li><a href="#">Canguros y buzos</a></li>
                      <li><a href="#">Remeras</a></li>
                     <li><a href="#">Conjuntos</a></li>
                 </ul>
                </li>

                <li class="itemdemenu"><a href="#">Hombre</a>
                    <ul class="menuvertical">
                        <li><a href="#">Pantalones</a></li>
                        <li><a href="#">Canguros y buzos</a></li>
                    </ul>
                </li>

                <li class="itemdemenu"><a href="#">Accesorios</a>
                    <ul class="menuvertical">
                        <li><a href="#">Medias</a></li>
                        <li><a href="#">Vasos y botellas</a></li>
                        <li><a href="#">Accesorios de cabello</a></li>
                        <li><a href="#">Bolsos</a></li>
                    </ul>
                </li>
                ';
                */

/* 
    if(isset($_POST['submit'])){
        $correosRegistrados = array_map(function($usuario) {return strtolower($usuario->getCorreo()); }, $_SESSION['usuarios'] ?? []);
        if (in_array($_POST['correo'], $correosRegistrados)) {
            if($_POST['pass'] == $_POST['pass2']){
                $usuario = new usuario($_POST['correo'],$_POST['pass'],$_POST['ci'],$_POST['nombre'],$_POST['tel']);
                if(!isset($_SESSION['usuarios'])){
                $_SESSION['usuarios'] = [];
                }
                $_SESSION['usuarios'][] = serialize($usuario);

            }else{
                echo '<script>alert("Las contraseñas no coinciden.");</script>';
            }
        }else{
            echo '<script>alert("El correo ingresado ya está registrado.");</script>';

        }
    }*/

/*switch (catExis($categoria, $subcategoria)) {
        case 0:
            $html= '<h1 style="text-align:center;">UPS... ESTA CATEGORÍA NO EXISTE</h1>';
            break;
        case 1:
                $productos = $_SESSION['Producto'];
                $html= "<div class='productos-container'>";
                foreach ($productos as $producto) {
                    $html .= "<div class='producto-card'>";
                    $html .= "<img src='Img/" . $producto->getFoto() . "' alt='Producto'>";
                    $html .= "<h3>" . $producto->getNombre() . " - " . $producto->getPrecio() . "</h3>";
                    $html .= "<p>Color: " . $producto->getColor() . "</p>";
                    $html .= "<p>Talle: " . $producto->getTalle() . "</p>";
                    $html .= "<button class='btn-agregar'><i class='bi bi-cart-plus'></i> Agregar al carrito</button>";
                    $html .= "</div>";
                }
                $html .= "</div>";
            break;
        case 2:
            $html = '<h1 style="text-align:center;">UPS... ESTA SUBCATEGORÍA NO EXISTE</h1><br><h1 style="text-align:center;">ESPERE Y SERÁ REDIRIGIDO A LA CATEGORÍA PRINCIPAL.</h1>';
            break;
    }*/
    /*$cates= [
        new cat("Mujer",["Calzas", "Pantalones", "Canguros y Buzos", "Remeras", "Conjuntos"], true),
        new cat("Hombre",["Pantalones", "Canguros"], true),
        new cat("Accesorios",["Medias", "Vasos y botellas", "Acccesorios de cabello", "Bolsos"], true)
        ];*/
?>
<div class="top">

    <form id="cart" class="cart site-cart-form" action="/cart" method="post" novalidate>

        <div class="cart-holder" data-items="2">

            <div class="cart-items">

                <div class="cart-item" data-js-cart-item data-variant="123" data-product-id="456" data-qty="1">

                    <a class="thumbnail" href="/product/123">
                        <figure class="lazy-image-small" style="padding-top:100%">
                            <img class="product-thumb" src="..." alt="...">
                        </figure>
                    </a>

                    <div class="content">

                        <a class="item-title" href="/product/123"><span class="underline-animation">Producto</span></a>
                        <div class="item-price text-size--smaller"><strong>$0.00</strong></div>
                        <div class="actions">

                            <product-quantity class="quantity-selector-holder">

                                <cart-product-quantity>
                                    <button class="qty-button qty-minus" type="button">-</button>
                                    <label class="visually-hidden" for="updates_123">Quantity</label>
                                    <input id="updates_123" class="qty qty-selector product__quantity" name="updates[]" type="number" min="0" value="1" data-href="/cart/change?line=1&quantity=$qty">
                                    <button class="qty-button qty-plus" type="button">+</button>
                                </cart-product-quantity>
                            
                            </product-quantity>
                            
                            <a class="remove text-size--smallest" href="#" data-href="/cart/change?line=1&quantity=0">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <span class="hidden" aria-hidden="true" data-cart-count>2</span>
</div>

<div class="top">

		<form action="/cart" method="post" novalidate="" class="cart site-cart-form-" id="cart">

		  <div class="cart-holder" data-items="1">

		    <div class="cart-items">
                <div class="cart-item" data-js-cart-item="" data-title="Uzi Solver Plush " data-id="51928952701293:cff03e2e91723daf473491acd26e17f8" data-variant="51928952701293" data-qty="1" data-product-id="14682237141357">

		          <a href="/products/uzi-solver-plush?variant=51928952701293" class="thumbnail"><figure class="lazy-image-small " data-ratio="" style="padding-top: 100%">
  
    <img src="//glitchproductions.store/cdn/shop/files/5.png?crop=center&amp;height=120&amp;v=1747803528&amp;width=120" srcset="
          //glitchproductions.store/cdn/shop/files/5.png?crop=center&amp;height=120&amp;v=1747803528&amp;width=120 100w, 
          //glitchproductions.store/cdn/shop/files/5.png?crop=center&amp;height=220&amp;v=1747803528&amp;width=220 200w, 
          //glitchproductions.store/cdn/shop/files/5.png?crop=center&amp;height=320&amp;v=1747803528&amp;width=320 300w
          //glitchproductions.store/cdn/shop/files/5.png?crop=center&amp;height=420&amp;v=1747803528&amp;width=420 400w
        " alt="" loading="lazy" sizes="110px" width="2000" height="2000" onload="this.classList.add('lazyloaded')" class="lazyloaded">
  
</figure></a>

		          <div class="content">

	<a href="/products/uzi-solver-plush?variant=51928952701293" class="item-title">
	    <span class="underline-animation">Uzi Solver Plush</span>
		    </a><div class="item-price text-size--smaller"><span class="visually-hidden">Regular price</span>
            <strong>$30.00</strong></div><div class="actions"><product-quantity class="quantity-selector-holder">
				<cart-product-quantity>
											<button class="qty-button qty-minus" aria-label="Decrease quantity" role="button" controls="updates_51928952701293">
											<svg width="12" height="12" viewBox="0 0 12 1" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.518738 0H11.5154V1H0.518738V0Z" fill="#262627"></path></svg>
											</button>
											<label for="qty-" class="visually-hidden">Quantity</label>
											<input type="number" name="updates[]" value="1" min="0" class="qty qty-selector product__quantity" id="updates_51928952701293" data-href="/cart/change?line=1&amp;quantity=$qty">
											<button class="qty-button qty-plus" aria-label="Increase quantity" role="button" controls="updates_51928952701293">
													<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.49988 0.503113V11.4998H5.49988V0.503113H6.49988Z" fill="#262627"></path><path d="M0.501526 5.49835H11.4982V6.49835H0.501526V5.49835Z" fill="#262627"></path></svg>
											</button>
											</cart-product-quantity>
										</product-quantity><a href="" class="remove text-size--smallest" title="Remove" data-href="/cart/change?line=1&amp;quantity=0">Remove</a>
			</div>
							</div>

		</div>
    </div>

		</div>

		</form>

<span class="hidden" aria-hidden="true" data-cart-count="">1</span>

	</div>



    //Cards
echo '
<div class="productos-container">
<div class="producto-card">
    <img src="Img\PolleraLu.jpg">
    <h3> Pollera Lu </h3>
    <p> $390 </p>
    <button id="addtocart" class="btnaggcarrito"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>
</div>';
echo '
<div class="producto-card">
    <img src="Img\ShortVal.jpg">
    <h3> Short Val </h3>
    <p> $320 </p>
    <button id="addtocart" class="btnaggcarrito"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>
</div>';
echo '
<div class="producto-card">
    <img src="Img\ShortBatik.jpg">
    <h3> Short Batik </h3>
    <p> $390 </p>
    <button id="addtocart" class="btnaggcarrito"><i class="bi bi-cart-plus"></i> Agregar al carrito</button>
</div>
</div>';