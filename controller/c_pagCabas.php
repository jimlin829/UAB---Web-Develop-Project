<?php
    $totalQuantity = 0;
    $totalPrice = 0.0;

    if(isset($_SESSION['cart'])) {
        $cartItems = $_SESSION['cart'];
        foreach ($cartItems as $item) {
            $totalQuantity += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'];
        }
    }

    include __DIR__ . '/../view/v_pagCabas.php';
?>