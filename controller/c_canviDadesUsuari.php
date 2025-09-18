<?php
    require_once __DIR__ . "/../models/m_connectaBD.php";
    require_once __DIR__ . "/../models/m_canviDadesUsuari.php";

    $connexio = connectaBD();

    $email = $_POST['email'] ?? null;
    $name = $_POST['name'] ?? null;
    $password = $_POST['password'] ?? null;
    $address = $_POST['address'] ?? null;
    $city = $_POST['city'] ?? null;
    $postalCode = $_POST['postalCode'] ?? null;

    
    if (isset($_FILES['profilePhoto']['tmp_name']) && !empty($_FILES['profilePhoto']['tmp_name'])) {
        $uploadOk = 1;
        $filesAbsolutePath = '/home/TDIW/tdiw-e5/public_html/uploadedFiles/';
        $nomFitxer = basename($_FILES["profilePhoto"]["name"]);
        $destinationPath = $filesAbsolutePath . $nomFitxer;
        $imageFileType = strtolower(pathinfo($destinationPath, PATHINFO_EXTENSION));
        if ($_FILES["profilePhoto"]["size"] > 500000) {
            $uploadOk = 0;
            $resposta = "Archivo demasiado grande.";
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $uploadOk = 0;
            $resposta = "El archivo debe ser de tipo JPG, JPEG, PNG o GIF.";
        }
        if ($uploadOk == 1) {
            move_uploaded_file($_FILES['profilePhoto']['tmp_name'], $destinationPath);
            $resposta = canviDadesUsuari($connexio, $name, $email, $password, $address, $city, $postalCode, $nomFitxer);
        }

    }
    else {
        $resposta = canviDadesUsuari($connexio, $name, $email, $password, $address, $city, $postalCode, $nomFitxer);
    }
    echo json_encode(['message' => $resposta]);
    
?>