async function mostraProductesPerCat(idCat) {
    var resposta = await fetch(`controller/c_getProducts.php?id_categoria=${idCat}`);
    if (!resposta.ok) {
        throw new Error('Error al obtener los productos'); 
    }

    var productes = await resposta.json();
    var productContainer = document.getElementById("catLayout");
    productContainer.innerHTML = "";
    productes.forEach(product => {
        var productCard =  `
            <div class="product-card" onclick="mostraProducteDetall(${product.id})">
                <img src="${product.imatge}">
                <h3>${product.nom} </h3>
                <p> Precio: ${product.preu} €</p>
            </div>
        `;
        productContainer.innerHTML += productCard;
    });
}  

async function mostraProducteDetall(id_Prod) {
    var resposta = await fetch(`controller/c_producteDetall.php?id=${id_Prod}`);
    if (!resposta.ok) {
        throw new Error('Error al obtener los productos'); 
    }

    var producte = await resposta.json();
    var productContainer = document.getElementById("catLayout");
    productContainer.innerHTML = `
        <div id="productDetail">
            <img src="${producte.imatge}">
            <div class="product-detail">
                <h3>${producte.nom}</h2>
                <p>${producte.descripcio}</p>
                <h4>Precio: ${producte.preu} €</h4>
                <label for="quantity_${producte.id}">Cantidad:</label>
                <input type="number" id="quantity_${producte.id}" value="1" min="1">
                <button class="add-to-cart" onclick="addToCart('${producte.id}', ${producte.preu}, '${producte.nom}', '${producte.imatge}')">Añadir al carrito</button>
            </div>
        </div>
    `;
}

async function registrarUsuari(event) {
    if (event) event.preventDefault();

    var data = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        confirmPassword: document.getElementById('confirm-password').value,
        address: document.getElementById('address').value,
        city: document.getElementById('city').value,
        postalcode: document.getElementById('postalCode').value
    };

    try {
        var resposta = await fetch("/controller/c_comprovaErrorsRegistre.php", {
            method: "POST",
            body: data
        });

        // Procesa la respuesta del servidor
        var result = await resposta.json();

        // Limpia mensajes de error previos
        var errorFields = form.querySelectorAll(".error-message");
        errorFields.forEach((field) => (field.innerText = ""));

        if (resposta.ok && !result.errors) {
            // Si la respuesta es exitosa y no hay errores
            document.getElementById("success").innerText = "Usuario registrado correctamente.";
            alert("Usuario registrado correctamente.");
        } else if (result.errors) {
            // Mostrar errores específicos debajo de cada campo
            Object.entries(result.errors).forEach(([field, message]) => {
                var errorField = document.getElementById(`error-${field}`);
                if (errorField) {
                    errorField.innerText = message;
                }
            });
        }
    } catch (error) {
        console.error("Hubo un error:", error.message);
        document.getElementById("success").innerText = "Hubo un problema con el registro.";
    }
}

async function registerUser(event) {
    event.preventDefault();

    var data = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        confirmPassword: document.getElementById('confirm-password').value,
        address: document.getElementById('address').value,
        city: document.getElementById('city').value,
        postalCode: document.getElementById('postalCode').value
    };

    try {
        var response = await fetch('/controller/c_registreUsuari.php', {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        });

        var result  = await response.json();

        if (result.message.startsWith("success")) {
            alert('Registro con éxito.');
            window.location.href = '/../index.php'; 
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error: ' + error.message);
    }
}

async function loginUser(event) {
    event.preventDefault(); 

    var email = document.getElementById('loginEmail').value;
    var passwd = document.getElementById('loginPassword').value;

    try {
        var response = await fetch('/controller/c_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                passwd: passwd
            }),
        });

        var data = await response.json(); 
        if (data.success) {
            alert(data.message);
            window.location.href = '../index.php';
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
        alert('Ocurrió un error al intentar iniciar sesión.');
    }
}

async function addToCart(productId, price, name, image){
    var quantityInput = document.getElementById(`quantity_${productId}`);
    var quantity = quantityInput.value;

    if (!productId || !price || !name || !image || quantity < 1) {
        alert("Error: Datos del producto incompletos o inválidos.");
        return;
    }

    try {
        var response = await fetch('/controller/c_cabas.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: parseInt(quantity),
                price: parseFloat(price),
                name: name,
                image: image
            }),
        });

        var data = await response.json();
        if (data.success) {
            alert(data.message);
            updateCartSummary(data.cartCount, data.cartTotal);
        } else {
            alert('Error: ' + data.message);
        }
    }
    catch (error) {
        console.error('Error en la solicitud:', error);
        alert('Ocurrió un error al intentar añadir el producto al carrito.');
    }
}

/*
async function updateCartSummary(){
    try {
        const response = await fetch('/controller/c_get_cart_summary.php');
        const data = await response.json();

        console.log(data);
        
        if(data.success){
            document.getElementById('cartItemCount').textContent = data.cantidad;
            document.getElementById('cartTotalPrice').textContent = data.precio_total.toFixed(2);
        }
        else {
            console.error('Error al actualizar el resumen del carrito:', data.message);
        }
    } catch (error) {
        console.error('Error al actualizar el resumen del carrito:', error);
    }
}
    */

function updateCartSummary(count, total) {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        cartCount.textContent = count;
    }

    const cartTotal = document.querySelector('.cart-total');
    if (cartTotal) {
        cartTotal.textContent = `(${total.toFixed(2)}€)`;
    }
}


async function updateUserData(event) {
    event.preventDefault();

    const form = document.getElementById('editForm');
    const formData = new FormData(form);

    try {
        var response = await fetch('/controller/c_canviDadesUsuari.php', {
            method: 'POST',
            body: formData
        });

        var result  = await response.json();

        if (result.message.startsWith("success")) {
            alert('Cambio de datos con éxito.');
            window.location.href = '/../index.php'; 
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Ocurrió un error: ' + error.message);
    }
}

async function finalizarCompra() {
    try {
        const response = await fetch('/controller/c_finalitzarCompra.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                action: 'finalizarCompra'
            }),
        });

        const data = await response.json();

        if (data.success) {
            setTimeout(function() {
                window.location.href = 'index.php?action=finalizarcompra';
            }, 1500);
        } else {
            alert('Error al finalizar la compra: ' + data.message);
        }
    } catch (error) {
        console.error('Error en la solicitud:', error);
        alert('Ocurrió un error al intentar finalizar la compra.');
    }
}

async function updateQuantity(productId, change) {
    try {
        const quantityElement = document.getElementById(`quantity-${productId}`);
        let currentQuantity = parseInt(quantityElement.textContent);

        const newQuantity = currentQuantity + change;

        if (newQuantity < 1) {
            alert('La cantidad no puede ser menor que 1.');
            return;
        }

        const response = await fetch('/controller/c_modificarQuantitatProducte.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                productId: productId,
                quantity: newQuantity,
            }),
        });

        const data = await response.json();

        if (data.success) {
            location.reload(); // Recarga la página para reflejar los cambios
        } else {
            alert('Hubo un error al actualizar la cantidad. Por favor, inténtalo de nuevo.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Hubo un error al procesar la solicitud.');
    }
}

async function eliminarProducto(productId) {
    if (confirm('¿Estás seguro de que deseas eliminar este producto del carrito?')) {
        try {
            const response = await fetch('/controller/c_eliminarProducteCabas.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ productId: productId }),
            });
            const data = await response.json();

            if (data.success) {
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un problema al intentar eliminar el producto del carrito.');
        }
    }
}

async function vaciarCarrito() {
    try {
        const response = await fetch('/controller/c_buidarCabas.php', {
            method: 'POST'
        });
        const data = await response.json();

        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Error: ' + data.message);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Hubo un problema al intentar vaciar el carrito.');
    }
}

function redigirBuscar() {
    const query = document.getElementById('search-query').value.trim();
    if (query) {
        window.location.href = `index.php?action=buscar&query=${encodeURIComponent(query)}`;
    } else {
        alert('Por favor, introduce un término de búsqueda.');
    }
}

function keyPress(event) {
    if (event.key === "Enter") {
        redigirBuscar();
    }
}