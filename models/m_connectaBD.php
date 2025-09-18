<?php
    function connectaBD() {
        $servidor = "127.0.0.1";
        $port = "5432";
        $DBnom = "tdiw-e5";
        $usuari = "tdiw-e5";
        $clau = "tdiw-e5";
        $connexio = pg_connect("host=$servidor port=$port dbname=$DBnom user=$usuari password=$clau") or die("Error Conexion");
        return($connexio);
    }
?>
