<?php 
    $categoryId = $_GET['id_categoria'];
    require_once __DIR__ . "/../models/m_connectaBD.php";
    require_once __DIR__ . "/../models/m_productes.php";
    $connexio = connectaBD();
    $productes = consultaProductesPerCategoria($connexio, $categoryId);
    echo json_encode($productes);
?>