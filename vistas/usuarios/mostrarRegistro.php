<?php
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}
?>

<h1> Registros </h1>

<form enctype="multipart/form-data" action="index.php">
    <label for="nombre">Nombre:</label>
        <input type="text" name ="nombre"/> <br>
    <label for="apellido1">Primer Apellido:</label>
        <input type="text" name="apellido1"/> <br>
        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" name="apellido2"/> <br>
    <label for="email">Email:</label>
        <input type="text" name="email"/> <br>
    <label for="contrasenia">Contraseña:</label>
        <input type="password" name="contrasenia"/> <br>
    <label for="imagen">Foto de perfil:</label>
        <input type ="file" name ="imagen"/> <br>
        <input type='hidden' name='action' value='procesarRegistro'>
        <input type='submit'>
</form>