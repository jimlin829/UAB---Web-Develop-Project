<div class="h1-container">
    <h1 class="h1-pedido">Mis Pedidos</h1>
</div>
    <?php if (isset($error)): ?>
        <p><?= htmlspecialchars($error) ?></p>
    <?php elseif (empty($pedidos)): ?>
        <div class="pedido">
            <p><strong>No has realizado ningún pedido todavía.</strong></p>
        </div>
    <?php else: ?>
        <?php foreach ($pedidos as $pedido): ?>
            <div class="pedido">
                <p><strong>Pedido realizado el:</strong> <?= htmlspecialchars(date("Y-m-d H:i:s", strtotime($pedido['data_creacio']))) ?></p>
                <p><strong>Total de productos:</strong> <?= htmlspecialchars($pedido['num_elements']) ?></p>
                <p><strong>Importe total:</strong> <?= number_format($pedido['import_total'], 2) ?> €</p>

                <div class="productos">
                    <h3>Productos:</h3>
                    <?php foreach ($pedido['productos'] as $producto): ?>
                        <div class="producto">
                            <img src="<?= htmlspecialchars($producto['producte_imagen']) ?>" alt="<?= htmlspecialchars($producto['producte_nom']) ?>">
                            <div>
                                <p><strong><?= htmlspecialchars($producto['producte_nom']) ?></strong></p>
                                <p>Cantidad: <?= htmlspecialchars($producto['quantitat']) ?></p>
                                <p>Subtotal: <?= number_format($producto['preu_total'], 2) ?> €</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>