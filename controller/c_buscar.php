<?php
    require_once __DIR__ . "/../models/m_connectaBD.php";
    require_once __DIR__ . '/../models/m_productes.php';

    $connexio = connectaBD();
    $query = isset($_GET['query']) ? trim($_GET['query']) : '';

    if (!empty($query)) {
        $productos = buscarProductos($connexio, $query); 
    } else {
        $productos = [];
    }

    include __DIR__ . '/../view/v_buscar.php';
?>