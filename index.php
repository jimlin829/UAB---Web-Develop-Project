<?php
    session_start();

    $accio = $_GET['action'] ?? NULL;
    $filesPublicPath = 'uploadedFiles/';
?>

<html>
    <head>
        <meta charset="UTF-8" />
        <title> Gamer Planet </title>
        <meta name="author" content="TDIW-e5" />
        <meta name="keywords" content="Gamer Planet" />
        <meta name="viewport" content="width=device-width, initialscale=1.0" />
        <link rel="icon" href="LOGO/joystick_game.ico" />
        <link rel="stylesheet" type="text/css" href="../CSS/style.css" />
        <script src="js/functions.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </head>
    <body>
        <header>
            <?php include __DIR__ . "/controller/c_menuSuperior.php"; ?>
        </header>
    <?php
        switch($accio) {
            case 'buscar':
                include __DIR__. "/controller/c_buscar.php";
                break;
            case 'register':
                include __DIR__. "/register.php";
                break;
            case 'login':
                include __DIR__. "/login.php";
                break;
            case 'myaccount':
                include __DIR__. "/controller/c_formulariEditarPerfil.php";
                break;
            case 'mispedidos':
                include __DIR__. "/controller/c_mispedidos.php";
                break;
            case 'logout':
                include __DIR__. "/controller/c_tancarSessio.php";
                break;
            case 'micesta':
                include __DIR__. "/controller/c_pagCabas.php";
                break;
            case 'finalizarcompra':
                include __DIR__. "/view/v_finalitzarCompra.php";
                break;
            default:
                include __DIR__. "/portada.php";
                break;
        }
        include __DIR__. "/controller/c_cartSummary.php";
    ?>
</html>