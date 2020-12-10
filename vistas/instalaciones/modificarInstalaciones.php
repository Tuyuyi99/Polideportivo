<?php
    
    $instalaciones = $data['instalaciones'];
    echo '
        <form action="index.php" method="get">
            <label for="imagen">
                <img src="imagenes/instalaciones/'.$instalaciones->imagen.'.png">
            </label>
            <input type="file" name="imagen" id="imagen" value="'.$instalaciones->imagen.'"><br>
            Nombre: <br><input type="text" name="nombre" value="'.$instalaciones->nombre.'" required><br>
            Descripción: <br><textarea name="descripcion" rows="5" cols="25">'.$instalaciones->descripcion.'</textarea><br>
            Precio: <br><input type="number" name="precio" min="1" max="999" value="'.$instalaciones->precio.'" step=".01" required><br><br>
            <input type="hidden" name="action" value="modificarInstalacion">
            <input type="hidden" name="idInstalacion" value="'.$instalaciones->idInstalacion'">
            <input type="submit">
        </form>