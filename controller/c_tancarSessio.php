<?php
    session_start();

    // Eliminar solo los datos de usuario
    unset($_SESSION['user_email']);

    // Redirigir al inicio
    session_destroy();
    header("Location: ../index.php");
    exit();
?>