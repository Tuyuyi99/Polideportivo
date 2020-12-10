
<h1>Iniciar sesión</h1>

<?php
	if (isset($data['msjError'])) {
		echo "<p style='color:red'>".$data['msjError']."</p>";
	}
	if (isset($data['msjInfo'])) {
		echo "<p style='color:blue'>".$data['msjInfo']."</p>";
	}
?>

<a href='index.php?action=mostrarRegistro'>Registrarse</a></p>

<form action='index.php'>
<label for="email">Email:</label>	
	<input type='text' name='email'/>
<label for="contrasenia">Contraseña:</label>
	<input type='password' name='contrasenia'/>
	<input type='hidden' name='action' value='procesarLogin'/>
	<input type='submit'>
</form>