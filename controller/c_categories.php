<?php
    require_once __DIR__. "/../models/m_connectaBD.php";
    require_once __DIR__. "/../models/m_categories.php";
    $connexio = connectaBD();
    $categories = consultaCategories($connexio);
    include __DIR__. "/../view/v_categories.php";
?>