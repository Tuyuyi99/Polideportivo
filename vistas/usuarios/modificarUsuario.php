<?php
        $usuario = $data['usuario'];
        echo '<h2>Modificar Usuario</h2>';


        echo '<form action="index.php" method="get">
                <label for="imagen">
                        <img src="imagenes/fotos_perfil/'.$usuario->imagen.'">
                </label>
                <input type="file" name="imagen" id="imagen" value="'.$usuario->imagen.'"><br>
                <input type="hidden" name="idUsuario" value="'.$usuario->idUsuario.'">
                <input type="hidden" name="action" value="modificarUsuario">
                Nombre: <br><input type="text" name="nombre" value="'.$usuario->nombre.'" size="50"><br>
                1º apellido: <br><input type="text" name="apellido1" value="'.$usuario->apellido1.'" size="50"><br>
                2º apellido: <br><input type="text" name="apellido2" value="'.$usuario->apellido2.'" size="50"><br>
                Contraseña: <br><input type="password" name="contrasenia" value="'.$usuario->contrasenia.'" size="50"><br>
                Correo electrónico: <br><input type="text" name="email" value="'.$usuario->email.'" size="50"><br>
                DNI: <br><input type="text" name="dni" value="'.$usuario->dni.'" size="50" max-length="9"><br>
                Rol: <br>
                <select name="rol">';

                if ($usuario->rol == 'administrador') {echo '<option value="Administrador" selected>Admin</option>';}
                else {echo '<option value="administrador">Admin</option>';}
                if ($usuario->rol == 'usuario') {echo '<option value="usuario" selected>Usuario</option>';}
                else {echo '<option value="usuario">usuario</option>';}
                if ($usuario->rol == 'deshabilitado') {echo '<option value="deshabilitado" selected>Deshabilitado</option>';}
                else {echo '<option value="deshabilitado">Deshabilitado</option>';}

                echo '</select>';
                echo '<br>';
                echo 'Añadir imagen: <input type="file" name="imagen" id="imagen" value="'.$usuario->imagen.'">';

                echo '<br><br>';
                echo '<input type="submit" value="Modificar usuario">
                </form>';
        echo '</div>';