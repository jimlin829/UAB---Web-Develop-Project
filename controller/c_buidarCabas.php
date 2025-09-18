<?php
    session_start();

    try {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
        }

        echo json_encode(['success' => true, 'message' => 'El carrito ha sido vaciado.']);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Error al vaciar el carrito: ' . $e->getMessage()]);
    }
?>