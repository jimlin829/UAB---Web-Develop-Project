<?php
session_start();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['productId'])) {
    $productId = $input['productId'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]);
        echo json_encode(['success' => true, 'message' => 'Producto eliminado del carrito.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Producto no encontrado en el carrito.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID de producto no proporcionado.']);
}