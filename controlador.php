<?php

//Incluimos todas las vistas que haya y modelos.

include_once("vista.php");
include_once("modelos/usuarios.php");
include_once("modelos/instalaciones.php");
include_once("modelos/reservas.php");

// Creamos los objetos vista y modelos


class Controlador
{

    private $vista, $usuarios, $instalaciones, $reservas;
    
    //Colocamos un constructor con los diferentes modelos antes inicializados.

	public function __construct(){
	
		$this->vista = new Vista();
		$this->usuarios = new Usuario();
		$this->instalaciones = new Incidencia();
		$this->reservas = new Reservas();
    }
    
    //Muestra el formulario de login

	public function showFormularioLogin(){
	
		$this->vista->show("usuarios/mostrarLogin");
	}
	

	public function procesarLogin(){
	
		$email = $_REQUEST["email"];
		$contrasenia = $_REQUEST["contrasenia"];

		$result = $this->usuarios->buscarUsuario($email, $contrasenia);

		if ($result) { //Si es correcto, lo redireccionamos a Calendario.php
		$this->showCalendario();
		} else {
			// Error al iniciar la sesión
			$data['msjError'] = "Nombre de usuario o contraseña incorrectos";
			$this->vista->show("usuarios/mostrarLogin", $data);
		}
	}

	public function cerrarSesion()
	{
		session_destroy();
		$data['msjInfo'] = "Sesión cerrada correctamente";
		$this->vista->show("usuarios/mostrarLogin", $data);
	}
	
	public function mostrarRegistro(){
	
	$this->vista->show("usuarios/mostrarRegistro");
	}
    
    public function procesarRegistro(){
	
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];
        $email = $_REQUEST["email"];
		$contrasenia = $_REQUEST["contrasenia"];

		$result = $this->usuarios->insert($nombre, $apellidos, $email, $contrasenia);

		if ($result) { //Si es correcto, lo redireccionamos a showFormularioLogin.php.
            $data['msjInfo'] = "¡Enhorabuena, ya te has registrado!";
			$this->vista->show("usuarios/mostrarLogin", $data);
		} else {
			// Error al registrarse
			$data['msjError'] = "Parece que ha ocurrido un error. Inténtalo de nuevo más tarde.";
			$this->vista->show("usuarios/mostrarRegistro", $data);
		}
	}

	public function showInsertarIncidencias(){
		$this->vista->show("incidencias/insertarIncidencias");
	}

	public function procesarReserva(){
	

		$equipo = $_REQUEST["equipo"];
		$fecha = $_REQUEST["fecha"];
		$lugar = $_REQUEST["lugar"];
		$descripcion = $_REQUEST["descripcion"];
		$observaciones = $_REQUEST["observaciones"];
		$estado = $_REQUEST["estado"];
		$idUsuario = $_SESSION["idUsuario"];

		$result = $this->incidencias->insert($equipo, $fecha, $lugar, $descripcion, $observaciones, $estado, $idUsuario);

		if ($result) { //Si es correcto, lo redireccionamos a listaIncidencias.php.
			$this->showListaIncidencias();
		} else {
			// Error al registrar la incidencia.
			$data['msjError'] = "Parece que ha ocurrido un error. Inténtalo de nuevo más tarde.";
			$data['listaIncidencias'] = $this->incidencias->getAll();
			$this->vista->show("incidencias/listaIncidencias", $data);
		}
	}

	public function borrarReserva(){
		if (isset($_SESSION["idUsuario"])) {
			$idIncidencia = $_REQUEST["idIncidencia"];
			// Eliminamos la incidencia a partir de su id
            $result = $this->incidencias->delete($idIncidencia);
            
            // Si no lo encuentra, lanzamos un mensaje de error. En caso contrario, lanzamos uno de información.
			if ($result == 0) {
				$data['msjError'] = "Ha ocurrido un error al borrar la incidencia. Por favor, inténtelo de nuevo";
			} else {
				$data['msjInfo'] = "incidencia borrado con éxito";
			}
			// Mostramos la lista de incidencias actualizada
			$data['listaIncidencias'] = $this->incidencias->getAll();
			$this->vista->show("incidencias/listaIncidencias", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuarios/formularioLogin", $data);
		}
	}
	
	public function showModificarReserva(){
		if (isset($_SESSION["idUsuario"])) {
			$idIncidencia = $_REQUEST["idIncidencia"];
			$data['incidencias'] = $this->incidencias->get($idIncidencia);
			$this->vista->show('incidencias/modificarIncidencias', $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuario/formularioLogin", $data);
		}
	}

	public function modificarReserva(){

		if (isset($_SESSION["idUsuario"])) {

			$idIncidencia = $_REQUEST["idIncidencia"];
			$equipo = $_REQUEST["equipo"];
			$fecha = $_REQUEST["fecha"];
			$lugar = $_REQUEST["lugar"];
			$descripcion = $_REQUEST["descripcion"];
			$observaciones = $_REQUEST["observaciones"];
			$estado = $_REQUEST["estado"];

			// Lanzamos el UPDATE contra la base de datos.
			$result = $this->incidencias->update($idIncidencia, $equipo, $fecha, $lugar, $descripcion, $observaciones, $estado);

			if ($result != 1) {
				// Si la modificación de incidencias ha fallado, mostramos un mensaje de error.
				$data['msjError'] = "Ha ocurrido un error al modificar la incidencia. Por favor, inténtelo más tarde.";
			}
			$data['listaIncidencias'] = $this->incidencias->getAll();
			$this->vista->show("incidencias/listaIncidencias", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuarios/mostrarLogin", $data);
		}

	}

	public function showCalendario(){
		if ((isset($_SESSION["rol"])) && ($_SESSION["rol"] == "usuario")){
		$data['listaIncidencias'] = $this->incidencias->getAll();
		} else {
			$data['listaIncidencias'] = $this->incidencias->getAllAdmin();
		}
		$this->vista->show("incidencias/listaIncidencias", $data);
	}
}
