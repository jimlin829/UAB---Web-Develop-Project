<?php

    function canviDadesUsuari($connexio, $nom, $email, $contrasenya, $direccio, $ciutat, $codiPostal, $fotoPerfil){
        if (empty($nom) || strlen($nom) < 3) {
            return "El nombre debe tener al menos 3 caracteres.";
        }

        else {
            $sql = "UPDATE usuari SET email = $1, name = $2, password = $3, address = $4, city = $5, postalcode = $6, photo = $7 WHERE email = $1";
            $contrasenyaXifrada = password_hash($contrasenya, PASSWORD_DEFAULT); // Xifrat de contrasenya
            $params = [$email, $nom, $contrasenyaXifrada, $direccio, $ciutat, $codiPostal, $fotoPerfil];
            $consulta = pg_query_params($connexio, $sql, $params);

            if ($consulta) {
                return "success: Cambio de datos realizado correctamente.";
            } else {
                return "error: Hubo un problema al cambiar los datos.";
            }
        }
    }
?>