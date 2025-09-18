<?php
    function consultaDadesCompte($connexio, $emailUser) {   
        $sql = "SELECT * FROM usuari WHERE email = $1";
        $params = [$emailUser];
        $consulta = pg_query_params($connexio, $sql, $params) or die("Error SQL");
        $dadesCompte = pg_fetch_all($consulta)[0];
        return($dadesCompte);
    }
?>