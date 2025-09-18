<h2>Resultados de la búsqueda: "<?= htmlspecialchars($query) ?>"</h2>
<div id="catLayout">
    <?php if (count($productos) > 0): ?>
        <?php foreach ($productos as $producto): ?>
            <div class="product-card" onclick="mostraProducteDetall(<?php echo $producto['id']; ?>)">
                <img src="<?php echo $producto['imatge'] ?>">
                <h3><?php echo $producto['nom'] ?> </h3>
                <p> Precio: <?php echo $producto['preu'] ?> €</p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p> No se encontraron productos que coincidan con tu búsqueda.</p>
    <?php endif; ?>
</div>