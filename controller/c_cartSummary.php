<?php
    $cartCount = 0;
    $cartTotal = 0;
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $cartCount += $item['quantity'];
            $cartTotal += $item['quantity'] * $item['price'];
        }
    }

    include __DIR__ . "/../view/v_cartSummary.php"
?>