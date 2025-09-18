<?php 
    $productId = $_GET['id'];
    require_once __DIR__ . "/../models/m_connectaBD.php";
    require_once __DIR__ . "/../models/m_productes.php";
    $connexio = connectaBD();
    $producte = consultaProducte($connexio, $productId);
    echo json_encode($producte);
?>