<?php
    require_once __DIR__ . "/../models/m_connectaBD.php";
    require_once __DIR__ . "/../models/m_accountData.php";
    $connexio = connectaBD();
    $emailUser = $_SESSION['user_email'];
    $accountData = consultaDadesCompte($connexio, $emailUser);
    $nom = $accountData['name'];
    $direccio = $accountData['address'];
    $ciutat = $accountData['city'];
    $codiPostal = $accountData['postalcode'];
    $fotoPerfil = $accountData['photo'];
    include __DIR__. "/../view/v_formulariEditarPerfil.php";
?>