<?php
    session_start();

    header('Content-Type: application/json');
    require_once __DIR__ . "/../models/m_connectaBD.php";

    // Verificar si hay una sesión activa
    if (!isset($_SESSION['user_email'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Debes iniciar sesión primero'
        ]);
        exit;
    }
    
    $getForm = file_get_contents('php://input');
    $data = json_decode($getForm, true);
    
    $product_id = $data['product_id'];
    $quantity = (int)$data['quantity'];
    $price = (float)$data['price'];
    $product_name = $data['name'];
    $product_image = $data['image'];

    // Ejemplo de cuando se añade un producto
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Añadir o actualizar producto en el carrito
    if (isset($_SESSION['cart'][$product_id])) {
        // Sumar la cantidad
        $_SESSION['cart'][$product_id]['quantity'] += $quantity;
    } else {
        // Añadir producto con más información
        $_SESSION['cart'][$product_id] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'name' => $product_name,
            'image' => $product_image
        ];
    }
     
    // Calcular totales
    $cartCount = 0;
    $cartTotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
        $cartTotal += $item['quantity'] * $item['price'];
    }

    // Devolver respuesta
    echo json_encode([
        'success' => true,
        'cartCount' => $cartCount,
        'cartTotal' => $cartTotal,
        'message' => 'Producto añadido al carrito'
    ]);
?>