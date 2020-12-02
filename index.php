<?php

//Iniciamos todas las sesiones

session_start();

//Instanciamos el objeto controlador, sobre el que la aplicación estará construida.

include_once("controlador.php");
    $controlador = new Controlador();
    
    // Recuperamos la acción de la URL. Si no hay, asignamos una por defecto
	if (isset($_REQUEST["action"])) {
		$action = $_REQUEST["action"];
	} else {
		$action = "showListaIncidencias";  // Acción por defecto
	}

	// Ejecutamos el método llamado como la acción del controlador
	$controlador->$action();

?>