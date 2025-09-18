<?php
    require_once __DIR__ . "/../models/m_connectaBD.php";

    $errores = [];
    $connexio = connectaBD();

    // Accede a los datos directamente desde $_POST
    $nom = $_POST["name"];
    $email = $_POST["email"];
    $contrasenya = $_POST["password"];
    $direccio = $_POST["address"];
    $ciutat = $_POST["city"];
    $codiPostal = $_POST["postalCode"];
    
    // Validaciones
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores["email"] = "El correo electrónico no es válido.";
    }

    if (empty($nom) || strlen($nom) < 3) {
        $errores["name"] = "El nombre debe tener al menos 3 caracteres.";
    } elseif (!preg_match("/^[a-zA-ZÀ-ÿ\s]+$/", $nom)) {
        $errores["name"] = "El nombre solo puede contener letras y espacios.";
    }

    if (strlen($contrasenya) < 8) {
        $errores["password"] = "La contraseña debe tener al menos 8 caracteres.";
    }

    if (empty($direccio)) {
        $errores["address"] = "La dirección no puede estar vacía.";
    }

    if (empty($ciutat)) {
        $errores["city"] = "La ciudad no puede estar vacía.";
    }

    if (!preg_match("/^[0-9]{5}$/", $codiPostal)) {
        $errores["postalCode"] = "El código postal debe ser un número de 5 dígitos.";
    }

    if (!empty($errores)) {
        // Si hay errores, devolverlos en formato JSON
        http_response_code(400); // Código de error
        echo json_encode(["errors" => $errores]);
        exit;
    }
?>