<?php
$incidencias = $data['incidencias'];

echo "<h1>Modificación de incidencias</h1>";

// Creamos el formulario con los campos de la incidencia
// y lo rellenamos con los datos que hemos recuperado de la base de datos.
echo "<form action = 'index.php' method = 'get'>
            <input type='hidden' name='idIncidencia' value='$incidencias->idIncidencia'>
            Equipo:<input type='text' name='equipo' value='$incidencias->equipo'><br>
            Fecha:<input type='text' name='fecha' value='$incidencias->fecha'><br>
            Lugar:<input type='text' name='lugar' value='$incidencias->lugar'><br>
            Descripción:<input type='text' name='descripcion' value='$incidencias->descripcion'><br>
            Observaciones:<input type='text' name='observaciones' value='$incidencias->observaciones'><br>
            Estado:<input type='text' name='estado' value='$incidencias->estado'><br>";

// Finalizamos el formulario
echo "  <input type='hidden' name='action' value='modificarIncidencias'>
            <input type='submit'>
          </form>";
echo "<p><a href='index.php'>Volver</a></p>";

?>
