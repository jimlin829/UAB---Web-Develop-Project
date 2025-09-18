<br>
<br>

<footer id="cartSummaryFooter">
    <div class="cart-summary-section">
        <strong class="cart-summary-section-title">Resumen de compra: </strong>
    </div>
    
    <div class="cart-summary-section">
        <i class="fa-solid fa-cart-shopping"></i> Número de productos: 
        <span class="cart-count"><?php echo $cartCount; ?></span>
    </div>
    <div class="cart-summary-section">
        <i class="fa-solid fa-coins"></i> Precio Total: <span class="cart-total"> <?php echo number_format($cartTotal, 2); ?>€</span>
    </div>
</footer>