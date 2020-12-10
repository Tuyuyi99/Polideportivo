<?php
    if (isset($data['msjInfo'])) {
        echo '<p>$data'.$data["msjInfo"].'"</p>';
    }
    if (isset($data['msjError'])) {
        echo '<p>$data'.$data["msjError"].'"</p>';
    }
    echo '<h2>Gestión de usuarios</h2>';
    echo '<a href="index.php?action=mostrarRegistro">Nuevo Usuario</a>';
    echo '<table id="tablaUsuarios">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Nombre</th>';
        echo '<th>Apellidos</th>';
        echo '<th>Email</th>';
        echo '<th>DNI</th>';
        echo '<th>Imagen</th>';
        echo '<th></th>';
        echo '<th></th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody';
        foreach($data['listaUsuarios'] as $usuarios) {
            echo '<tr>';
            echo '<td>'.$usuarios->idUsuario.'</td>';
            echo '<td>'.$usuarios->nombre.'</td>';
            echo '<td>'.$usuarios->apellido1.''.$usuarios->apellido2.'</td>';
            echo '<td>'.$usuarios->email.'</td>';
            echo '<td>'.$usuarios->dni.'</td>';
            echo '<td><a href="#">Ampliar imagen</a></td>';
            echo '<td><a href="index.php?action=modificarUsuario&idUsuario='.$usuarios->idUsuario.'">
                    <img class="botonModificar" src="imgs/button-edit.png" id="buttonEdit" alt="Modificar usuario" title="Modificar usuario"></a></td>';
            echo '<td class="celdaEliminar"><a href="index.php?action=confirmacionBorrarUsuario&idUsuario='.$usuarios->idUsuario.'">
                    <img class="botonCancelar"src="imgs/button-cancelar.png" id="botonBorrar" alt="Eliminar usuario" title="Eliminar usuario"></a></td>';
            echo '</tr><tr class="filaEspacio"><td></td></tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';