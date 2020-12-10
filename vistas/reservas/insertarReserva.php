<?php
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."";
	}
?>

<h1> Nueva Reserva </h1>

<form action="index.php">
  <label for="fecha">Fecha:</label>
    <input type="date" name ="fecha"/>
  <label for="hora">Hora:</label>
    <input type="time" name="hora"/><br>
  <label for="precio">Precio:</label>
    <input type="text" name="precio"/>
    <input type='hidden' name='action&idUsuario' value='procesarReserva'>
    <input type='submit'>
</form>