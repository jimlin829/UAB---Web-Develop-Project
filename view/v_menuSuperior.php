<div class="header-container">
    <!-- Logo -->
    <div class="logo" style="grid-area: logo">
        <a href="https://tdiw-e5.deic-docencia.uab.cat"> 
            <img src="/LOGO/logo3.png" width="320">
        </a>
    </div>

    <!-- Barra de búsqueda -->
    <div class="search-bar" style="grid-area: searchbar">
        <input type="text" id="search-query" placeholder="Buscar productos..." onkeypress="keyPress(event)">
        <button type="button" onclick="redigirBuscar()">
            <i class="fa-solid fa-magnifying-glass"></i> Buscar
        </button>
    </div>

    <!-- Opciones de la derecha -->
    <div class="header-options" style="grid-area: option1">
        <div class="menu">
            <a> <i class="fas fa-user"></i> Mi Cuenta</a>
            <div class="menu-options">
                <?php
                    if (!$autenticacio) {
                        echo '<a href="index.php?action=register">Registrar</a>';
                        echo '<a href="index.php?action=login">Iniciar Sesión</a>';
                    }
                    else {
                        echo '<a href="index.php?action=myaccount">Mi cuenta</a>';
                        echo '<a href="index.php?action=mispedidos">Mis pedidos</a>';
                        echo '<a href="index.php?action=logout">Cerrar sesión</a>';
                    }
                ?>
            </div>
        </div>
    </div>

    <div class="header-options" style="grid-area: option2">
        <?php echo '<a href="index.php?action=micesta" class="cart-link">'?> <i class="fas fa-shopping-cart"></i> Mi Cesta </a>
    </div>
</div>