<?php
    require_once __DIR__ . "/../models/m_connectaBD.php";
    require_once __DIR__ . "/../models/m_registreUsuari.php";

    $connexio = connectaBD();
    
    $getForm = file_get_contents('php://input');
    $data = json_decode($getForm, true);

    $email = $data['email'] ?? null;
    $name = $data['name'] ?? null;
    $password = $data['password'] ?? null;
    $address = $data['address'] ?? null;
    $city = $data['city'] ?? null;
    $postalCode = $data['postalCode'] ?? null;  

    $resposta = registreUsuari($connexio, $name, $email, $password, $address, $city, $postalCode);
    echo json_encode(['message' => $resposta]);
?>