<?php

echo '<form action="index.php" method="post" id="formCrearInstalacion">
            Nombre: <br><input type="text" name="nombre"  required><br>
            Descripción: <br><textarea name="descripcion" rows="4" cols="30"></textarea><br>
            Precio: <br><input type="number" name="precio" min="1" max="999" required><br><br>
            <input type="hidden" name="action" value="insertarInstalacion">
            <input type="submit">
        </form>'
        
?>