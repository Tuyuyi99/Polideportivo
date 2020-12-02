<?php

	// Enlace a "Iniciar sesión" o "Cerrar sesión"
	if (isset($_SESSION["idUsuario"])) {
		echo "<p><a href='index.php?action=cerrarSesion'>Cerrar sesión</a></p>";
	}
	else {
		echo "<p><a href='index.php?action=showFormularioLogin'>Iniciar sesión</a></p>";
	}
	if (!isset($_SESSION["idUsuario"])) {
		echo "<p><a href='index.php?action=mostrarRegistro'>Registrarse</a></p>";
	}

if (count($data['listaIncidencias']) > 0) {

echo "<table border ='1' class='tabla'>";
	foreach($data['listaIncidencias'] as $incidencia) {
		if (isset($_SESSION["idUsuario"])){
			echo "<tr class='modo'>";
			echo "<td>" . $incidencia->equipo . "</td>";
			echo "<td>" . $incidencia->fecha . "</td>";
			echo "<td>" . $incidencia->lugar . "</td>";
			echo "<td>" . $incidencia->descripcion . "</td>";
            echo "<td>" . $incidencia->observaciones . "</td>";
            echo "<td>" . $incidencia->estado . "</td>";
			// Los botones "Modificar" y "Borrar" solo se muestran si hay una sesión iniciada
			if (isset($_SESSION["idUsuario"])) {
				echo "<td><a href='index.php?action=showModificarIncidencias&idIncidencia=" . $incidencia->idIncidencia . "'>Modificar Incidencia</a></td>";
			}
			if ((isset($_SESSION["rol"])) && ($_SESSION["rol"] == "administrador")){
				echo "<td><a href='index.php?action=borrarIncidencia&idIncidencia=" . $incidencia->idIncidencia . "'>Borrar Incidencia</a></td>";
			}
			echo "</tr>";
		} else {
			echo "<p>Para ver tus incidencias, inicia sesión.</p>";
		}
	}
	echo "</table>";
	} 
	else {
		// La consulta no contiene registros
		echo "<p>No se encontraron datos</p>";
	}
	// El botón "Nueva incidencia" solo se muestra si hay una sesión iniciada
	if (isset($_SESSION["idUsuario"])) {
		echo "<p><a href='index.php?action=showInsertarIncidencias'>Nueva Incidencia</a></p>";
    }
?>