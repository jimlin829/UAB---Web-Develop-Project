<?php
    function consultaCategories($connexio){
        $sql = "SELECT * FROM categoria ORDER BY id";
        $consulta = pg_query($connexio, $sql) or die("Error SQL");
        $categories = pg_fetch_all($consulta);
        return($categories);
    }
?>