<div class="h1-container">
    <h1 class="h1-pedido">Mi Cesta</h1>
</div>
<table>
    <thead>
        <tr>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($cartItems)): ?>
            <tr>
                <td colspan="6">Tu carrito está vacío.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($cartItems as $productId => $item): ?>
                <tr>
                    <td><img src="<?= htmlspecialchars($item['image']) ?>" alt="Imagen de <?= htmlspecialchars($item['name']) ?>" width="50"></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= number_format($item['price'], 2) ?> €</td>
                    <td>
                        <button class="btn-quantity" onclick="updateQuantity(<?= $productId ?>, 1)">+</button>
                        <span id="quantity-<?= $productId ?>"><?= $item['quantity'] ?></span>
                        <button class="btn-quantity" onclick="updateQuantity(<?= $productId ?>, -1)">-</button>
                    </td>
                    <td><?= number_format($item['price'] * $item['quantity'], 2) ?> €</td>
                    <td> <button class="btn-eliminar" onclick="eliminarProducto(<?= $productId ?>)">Eliminar</button> </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div class="cart-summary">
    <strong>Total de productos:</strong> <?= $totalQuantity ?><br>
    <strong>Total a pagar:</strong> <?= number_format($totalPrice, 2) ?> € 
    <br>
    <button class="btn-vaciar" onclick="vaciarCarrito()">Vaciar Carrito</button>
</div>

<button class="btn-finalizar" onclick="finalizarCompra();">Finalizar Compra</button>