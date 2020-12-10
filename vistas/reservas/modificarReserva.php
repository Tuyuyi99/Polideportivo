<?php
$reservas = $data['reservas'];

echo "<h1>Modificación de reservas</h1>";

echo "<form action = 'index.php' method = 'get'>
            <input type='hidden' name='idIncidencia' value='$reservas->idReserva'>
            Fecha:<input type='date' name='fecha' value='$reservas->fecha'><br>
            Hora:<input type='time' name='hora' value='$reservas->hora'><br>
            Precio:<input type='number' name='precio' value='$reservas->precio'><br>";

// Finalizamos el formulario
echo "  <input type='hidden' name='action' value='modificarReservas'>
            <input type='submit'>
          </form>";
echo "<p><a href='index.php'>Volver</a></p>";

?>
