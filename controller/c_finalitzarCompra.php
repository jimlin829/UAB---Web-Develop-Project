<?php
    session_start();
    require_once __DIR__ . "/../models/m_connectaBD.php";

    $connexio = connectaBD();
    $cartItems = $_SESSION['cart'] ?? [];
    $userEmail = $_SESSION['user_email'] ?? null;

    if (empty($cartItems)) {
        echo json_encode(['message' => 'El carrito está vacío.']);
        exit;
    }

    if (!$userEmail) {
        echo json_encode(['message' => 'Usuario no autenticado.']);
        exit;
    }

    try {
        pg_query($connexio, 'BEGIN');

        $numElements = 0;
        $totalPrice = 0.0;

        foreach ($cartItems as $item) {
            $numElements += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['price'];
        }

        $queryComanda = "INSERT INTO Comanda (data_creacio, num_elements, import_total, email_usuari) VALUES (NOW(), $1, $2, $3) RETURNING id";
        $resultComanda = pg_query_params($connexio, $queryComanda, [$numElements, $totalPrice, $userEmail]);

        if (!$resultComanda) {
            throw new Exception('Error al insertar la comanda.');
        }

        $comandaId = pg_fetch_result($resultComanda, 0, 'id');

        $queryLinea = "INSERT INTO Linia_comanda (quantitat, preu_total, id_comanda, id_producte) VALUES ($1, $2, $3, $4)";
        foreach ($cartItems as $item) {
            $paramsLinea = [$item['quantity'], $item['quantity'] * $item['price'], $comandaId, $item['product_id']];
            $resultLinea = pg_query_params($connexio, $queryLinea, $paramsLinea);

            if (!$resultLinea) {
                throw new Exception('Error al insertar la línea de comanda.');
            }
        }
        

        pg_query($connexio, 'COMMIT');

        $_SESSION['resumenCompra'] = [
            'productos' => $cartItems,
            'numElements' => $numElements,
            'totalPrice' => $totalPrice
        ];
        unset($_SESSION['cart']);

        echo json_encode(['success' => true, 'message' => 'Compra finalizada con éxito.']);
    } catch (Exception $e) {
        pg_query($connexio, 'ROLLBACK');
        echo json_encode(['success' => false, 'message' => 'Error al procesar la compra: ' . $e->getMessage()]);
    }

?>