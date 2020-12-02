<?php
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}
?>

<h1> Registros </h1>

<form action="index.php">
    <label for="nombre">Nombre:</label>
        <input type="text" name ="nombre"/>
    <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos"/>
    <label for="email">Email:</label>
        <input type="text" name="email"/>
    <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia"/>
        <input type='hidden' name='action' value='procesarRegistro'>
        <input type='submit'>
</form>