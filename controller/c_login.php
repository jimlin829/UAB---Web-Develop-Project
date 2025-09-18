<?php
    session_start();
    require_once __DIR__ . "/../models/m_connectaBD.php";

    $getForm = file_get_contents('php://input');
    $data = json_decode($getForm, true);

    /*
    $email = $_POST["loginEmail"];
    $password = $_POST["loginPassword"];
    */

    $email = $data['email'] ?? null;
    $password = $data['passwd'] ?? null;

    if (!$email || !$password) {
        echo json_encode(["success" => false, "message" => "Faltan datos para iniciar sesión."]);
        exit();
    }

    $connexio = connectaBD();

    $sql = "SELECT * FROM usuari WHERE email = $1";
    $result = pg_query_params($connexio, $sql, [$email]);
    
    if ($result && pg_num_rows($result) > 0) {
        $user = pg_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_email'] = $user['email'];
            
            // Inicializar el carrito si no existe
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            echo json_encode(["success" => true, "message" => "Inicio de sesión con éxito"]);
            

        } else {
            echo json_encode(["success" => false, "message" => "Contraseña incorrecta"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Usuario no está registrado"]);
    }
?>