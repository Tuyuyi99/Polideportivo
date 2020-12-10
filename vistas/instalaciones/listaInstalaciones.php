<?php

    $contador = 0;

    echo '<h2>Lista de instalaciones</h2>';

    echo '<a href="index.php?action=mostrarInsertarInstalaciones">Insertar Instalacion</a>';

    if (isset($data['msjInfo'])) {
        echo '<p style="color:green">'.$data['msjInfo'].'</p>';
    }
    if (isset($data['msjError'])) {
        echo '<p style="color:red">'.$data['msjError'].'</p>';
    }
        echo '<table id="tablaInstalaciones">';

    foreach($data['listaInstalaciones'] as $instalaciones) {
        if ($contador % 2 == 0) {
            echo '<tr>';
        }
        echo '<td>
                <p>'.$instalaciones->nombre.' (<strong>'.$instalaciones->precio.'€/hora</strong>)</p>
                <table>
                <tr><td>
                <img src="imagenes//instalaciones/'.$instalaciones->imagen.'" width="100" height="100""<br></td>
                <table>
                <tr>
                <a href="index.php?action=showModificarInstalacion&idInstalacion='.$instalaciones->idInstalacion.'">
                <button>Modificar</button>
                </a>
                </tr>
                <tr>
                <a href="index.php?action=confirmarEliminarInstalacion&idInstalacion='.$instalaciones->idInstalacion.'">
                <button>Eliminar instalacion</button>
                </a>
                </tr>
                </table>
                </td>
                </tr>
                </table>
                
              </td>';
        $contador++;

        if ($contador % 2 == 0) {
            echo '</tr>';
        }
    }