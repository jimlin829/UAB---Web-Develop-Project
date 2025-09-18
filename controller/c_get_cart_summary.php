<?php
    session_start();
    $totalCantidad = 0;
    $totalPrecio = 0.0;
    header('Content-Type: application/json');
    
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $totalCantidad += $item['quantity'];
            $totalPrecio += $item['price'] * $item['quantity'];
        }
    }
    
    echo json_encode([
        "success" => true,
        'cantidad' => $totalCantidad,
        'precio_total' => $totalPrecio
    ]);
    ?>
?>