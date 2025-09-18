<?php 
    function consultaProductesPerCategoria($connexio, $idCat) {
        $sql = "SELECT * FROM producte WHERE id_categoria = $idCat ORDER BY id";
        $consulta = pg_query($connexio, $sql) or die("Error SQL");
        $productesPerCat = pg_fetch_all($consulta);
        return($productesPerCat);
    }

    function consultaProducte($connexio, $idProd) {
        $sql = "SELECT * FROM producte WHERE id = $idProd";
        $consulta = pg_query($connexio, $sql) or die("Error SQL");
        $producte = pg_fetch_all($consulta)[0];
        return($producte);
    }

    function buscarProductos($connexio, $query) {
        $query = '%' . pg_escape_string($connexio, $query) . '%';
        $sql = "SELECT * FROM Producte WHERE nom ILIKE $1 OR descripcio ILIKE $1";
        $result = pg_query_params($connexio, $sql, [$query]);
    
        if ($result) {
            return pg_fetch_all($result) ?: [];
        } else {
            return [];
        }
    }
?>