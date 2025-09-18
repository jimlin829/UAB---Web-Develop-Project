<?php
    session_start();

    $resumenCompra = $_SESSION['resumenCompra'] ?? null;

    if (!$resumenCompra) {
        echo "<p>Error: No se pudo recuperar el resumen de la compra.</p>";
        exit;
    }
?>
<div class="resumen-compra-container">
    <h1>¡Compra confirmada! Gracias por tu compra.</h1>
    <hr>
    <h2>Resumen de tu compra: </h2>
    <ul class="product-list">
        <?php foreach ($resumenCompra['productos'] as $producto): ?>
            <li>
                <img src="<?= htmlspecialchars($producto['image']) ?>" alt="<?= htmlspecialchars($producto['name']) ?>" >
                <div class="product-info">
                    <h3><?= htmlspecialchars($producto['name']) ?></h3>
                    <p>Cantidad: <?= htmlspecialchars($producto['quantity']) ?></p>
                    <p>Precio por unidad: <?= number_format($producto['price'], 2) ?> €</p>
                    <p><strong>Subtotal:</strong> <?= number_format($producto['quantity'] * $producto['price'], 2) ?> €</p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
    <div class="resumen-totales">
        <p><strong>Total de productos:</strong> <?= $resumenCompra['numElements'] ?></p>
        <p><strong>Total a pagar:</strong> <?= number_format($resumenCompra['totalPrice'], 2) ?> €</p>
    </div>
</div>
