<?php
    function isUserRegistered($connexio, $emailUser) {
        
        $sql = "SELECT COUNT(*) FROM usuari WHERE email = $1";
        $checkParams = [$emailUser];
        $checkResult = pg_query_params($connexio, $sql, $checkParams);

        if ($checkResult) {
            $row = pg_fetch_result($checkResult, 0, 0);
            if ($row > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    function registreUsuari($connexio, $nom, $email, $contrasenya, $direccio, $ciutat, $codiPostal){
        if (isUserRegistered($connexio, $email)) {
            return "El usuario ya existe.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "El correo electrónico no es válido.";
        }
        if (empty($nom) || strlen($nom) < 3) {
            return "El nombre debe tener al menos 3 caracteres.";
        }

        else {
            $sql = "INSERT INTO usuari (email, name, password, address, city, postalcode) VALUES($1, $2, $3, $4, $5, $6)";
            $contrasenyaXifrada = password_hash($contrasenya, PASSWORD_DEFAULT); // Xifrat de contrasenya
            $params = [$email, $nom, $contrasenyaXifrada, $direccio, $ciutat, $codiPostal];
            $consulta = pg_query_params($connexio, $sql, $params);

            if ($consulta) {
                return "success: Usuario registrado correctamente.";
            } else {
                return "error: Hubo un problema al registrar al usuario.";
            }
        }
    }
?>