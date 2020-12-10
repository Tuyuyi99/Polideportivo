<?php

    $contador = 0;

    echo '<h2>Lista de instalaciones</h2>';

    echo '<a href="index.php?action=insertarInstalaciones">Insertar Instalacion</a>';

    if (isset($data['msjInfo'])) {
        echo '<p style="color:green">'.$data['msjInfo'].'</p>';
    }
    if (isset($data['msjError'])) {
        echo '<p style="color:red">'.$data['msjError'].'</p>';
    }
        echo '<table id="tablaInstalaciones">';

    foreach($data['listaInstalaciones'] as $instalacion) {
        if ($contador % 2 == 0) {
            echo '<tr>';
        }
        echo '<td>
                <p>'.$instalacion->nombre.' (<strong>'.$instalacion->precio.'€/hora</strong>)</p>
                <table>
                <tr><td>
                <img src="imgs/instalaciones/'.$instalacion->imagen.'.png"<br></td>
                <td class="celdaModificarInstalacion'.$instalacion->idInstalacion'">
                <table>
                <tr>
                <a href="index.php?action=formModificarInstalacion&idInstalacion='.$instalacion->idInstalacion.'">
                <button class="botonModificarInstalacion">Modificar</button>
                </a>
                </tr>
                <tr>
                <a href="index.php?action=confirmarBorrarInstalacion&idInstalacion='.$instalacion->idInstalacion.'">
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