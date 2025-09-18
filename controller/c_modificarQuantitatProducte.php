<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['productId'];
$newQuantity = $data['quantity'];

if (isset($_SESSION['cart'][$productId])) {
    $_SESSION['cart'][$productId]['quantity'] = $newQuantity;

    $newTotal = 0;
    foreach ($_SESSION['cart'] as $item) {
        $newTotal += $item['price'] * $item['quantity'];
    }

    echo json_encode(['success' => true, 'newTotal' => $newTotal]);
} else {
    echo json_encode(['success' => false]);
}
?>