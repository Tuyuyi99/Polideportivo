<header>
    <div class="logo">
        <img src="imgs/logo-sin-imagen.png">
    </div>
<?php

include_once("modelos/seguridad.php");

    if ($_SESSION['rol'] == 'administrador') {
        echo '<section class="wrapper">
        <nav>
            <ul>
                <li><a href="index.php?action=mostrarListaUsuarios">Usuarios</a></li>
                <li><a href="index.php?action=mostrarListaInstalaciones">Instalaciones</a></li>
                <li><a href="index.php?action=mostrarCalendario">Reservas</a></li>
            </ul>
        </nav>
    </section>';
    }
    
?>
</header>