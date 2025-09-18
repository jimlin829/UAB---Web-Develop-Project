<?php
    function obtenerPedidos($email) {
        $connexio = connectaBD();
    
        $queryComandas = "SELECT c.id AS comanda_id, c.data_creacio, c.num_elements, c.import_total
                          FROM Comanda c
                          JOIN Usuari u ON c.email_usuari = u.email
                          WHERE u.email = $1
                          ORDER BY c.data_creacio DESC";
        $resultComandas = pg_query_params($connexio, $queryComandas, [$email]);
    
        $pedidos = [];
        while ($comanda = pg_fetch_assoc($resultComandas)) {
            $comanda_id = $comanda['comanda_id'];
    
            $queryLineas = "SELECT lc.quantitat, lc.preu_total, p.nom AS producte_nom, p.imatge AS producte_imagen
                            FROM Linia_comanda lc
                            JOIN Producte p ON lc.id_producte = p.id
                            WHERE lc.id_comanda = $1";
            $resultLineas = pg_query_params($connexio, $queryLineas, [$comanda_id]);
    
            $lineas = [];
            while ($linea = pg_fetch_assoc($resultLineas)) {
                $lineas[] = $linea;
            }
    
            $comanda['productos'] = $lineas;
            $pedidos[] = $comanda;
        }
    
        pg_close($connexio);
        return $pedidos;
    }
?>

<?php
    require_once __DIR__ . '/../models/m_connectaBD.php';
    
    $userEmail = $_SESSION['user_email'] ?? null;

    if ($userEmail) {
        $pedidos = obtenerPedidos($userEmail);
    } else {
        $pedidos = [];
        $error = "Debes iniciar sesión para ver tus pedidos.";
    }

    include __DIR__ . '/../view/v_mispedidos.php';
?>