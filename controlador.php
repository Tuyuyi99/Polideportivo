<?php

//Incluimos todas las vistas que haya y modelos.

include_once("vista.php");
include_once("modelos/usuarios.php");
include_once("modelos/instalaciones.php");
include_once("modelos/reservas.php");
include_once("modelos/seguridad.php");

// Creamos los objetos vista y modelos


class Controlador
{

    private $vista, $usuarios, $instalaciones, $reservas, $seguridad;
    
    //Colocamos un constructor con los diferentes modelos antes inicializados.

	public function __construct(){
	
		$this->vista = new Vista();
		$this->usuarios = new Usuario();
		$this->instalaciones = new Instalaciones();
		$this->reservas = new Reservas();
		$this->seguridad = new Seguridad();
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
		$this->seguridad->abrirSesion($result);
		$this->showCalendario();
		} else {
			// Error al iniciar la sesión
			$data['msjError'] = "Email o contraseña incorrectos";
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

		$email = $_REQUEST["email"];
        $contrasenia = $_REQUEST["contrasenia"];
        $nombre = $_REQUEST["nombre"];
        $apellido1 = $_REQUEST["apellido1"];
        $apellido2 = $_REQUEST["apellido2"];
        $dni = $_REQUEST["dni"];
		$imagen = $_REQUEST["imagen"];
		$rol = $_REQUEST["rol"];

		$result = $this->usuarios->insert($email, $contrasenia, $nombre, $apellido1, $apellido2, $dni, $imagen, $rol);

		if ($result) { //Si es correcto, lo redireccionamos a mostrarLogin.php.
            $data['msjInfo'] = "¡Enhorabuena, ya te has registrado!";
			$this->vista->show("usuarios/mostrarLogin", $data);
		} else {
			// Error al registrarse
			$data['msjError'] = "Parece que ha ocurrido un error. Inténtalo de nuevo más tarde.";
			$this->vista->show("usuarios/mostrarRegistro", $data);
		}
	}

	public function showInsertarReserva(){
		$this->vista->show("reservas/insertarReserva");
	}


	public function procesarReserva(){
	

		$fecha = $_REQUEST["fecha"];
        $hora = $_REQUEST["hora"];
        $precio = $_REQUEST["precio"];
		$idUsuario = $_SESSION["idUsuario"];

		$result = $this->reservas->insert($fecha, $hora, $precio, $idUsuario);

		if ($result) { //Si es correcto, lo redireccionamos a Calendario.php.
			$this->showCalendario();
		} else {
			// Error al registrar la incidencia.
			$data['msjError'] = "Parece que ha ocurrido un error. Inténtalo de nuevo más tarde.";
			$data['calendario'] = $this->reservas->getAll();
			$this->vista->show("reservas/calendario", $data);
		}
	}

	public function borrarReserva(){
		if (isset($_SESSION["idUsuario"])) {
			$idReserva = $_REQUEST["idReserva"];
			// Eliminamos la reserva a partir de su id
            $result = $this->reservas->delete($idReserva);
            
            // Si no lo encuentra, lanzamos un mensaje de error. En caso contrario, lanzamos uno de información.
			if ($result == 0) {
				$data['msjError'] = "Ha ocurrido un error al borrar la reserva. Por favor, inténtelo de nuevo";
			} else {
				$data['msjInfo'] = "reserva borrado con éxito";
			}
			// Mostramos la lista de incidencias actualizada
			$data['calendario'] = $this->reservas->getAll();
			$this->vista->show("reservas/calendario", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuarios/formularioLogin", $data);
		}
	}
	
	public function showModificarReserva(){
		if (isset($_SESSION["idUsuario"])) {
			$idReserva = $_REQUEST["idReserva"];
			$data['reservas'] = $this->reservas->get($idReserva);
			$this->vista->show('reservas/modificarReservas', $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuario/formularioLogin", $data);
		}
	}

	public function modificarReserva(){

		if (isset($_SESSION["idUsuario"])) {

			$idReserva = $_REQUEST["idReserva"];
			$fecha = $_REQUEST["fecha"];
			$hora = $_REQUEST["hora"];
			$precio = $_REQUEST["descripcion"];

			// Lanzamos el UPDATE contra la base de datos.
			$result = $this->reservas->update($idReserva, $fecha, $hora, $precio);

			if ($result != 1) {
				// Si la modificación de reservas ha fallado, mostramos un mensaje de error.
				$data['msjError'] = "Ha ocurrido un error al modificar la reserva. Por favor, inténtelo más tarde.";
			}
			$data['calendario'] = $this->reservas->getAll();
			$this->vista->show("reservas/calendario", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuarios/mostrarLogin", $data);
		}

	}
	
	public function showCalendario(){
			$data['mostrarReservas'] = $this->reservas->getAll();
			$this->vista->show("reservas/calendario", $data);
		
	}
	
	public function mostrarListaUsuarios(){
		if ((isset($_SESSION["rol"])) && ($_SESSION["rol"] == "administrador")){
			$data['listaUsuarios'] = $this->usuarios->getAll();
				$this->vista->show("usuarios/listaUsuarios",$data);
		}else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuarios/mostrarLogin", $data);
		}
		
	}
	
	public function mostrarListaInstalaciones(){
		$data['listaInstalaciones'] = $this->instalaciones->getAll();
				$this->vista->show("instalaciones/listaInstalaciones",$data);
	
	}

	public function mostrarInsertarInstalaciones(){
		$this->vista->show("instalaciones/insertarInstalaciones");
	}

	public function insertarInstalacion(){
		$nombre = $_REQUEST["nombre"];
        $descripcion = $_REQUEST["descripcion"];
        $imagen = $_REQUEST["imagen"];
		$precio = $_REQUEST["precio"];

		$result = $this->instalaciones->insert($nombre, $descripcion, $imagen, $precio);

		if ($result) { //Si es correcto, lo redireccionamos a Calendario.php.
			$this->showCalendario();
		} else {
			// Error al registrar la incidencia.
			$data['msjError'] = "Parece que ha ocurrido un error. Inténtalo de nuevo más tarde.";
			$data['listaIncidencias'] = $this->reservas->getAll();
			$this->vista->show("reservas/Calendario", $data);
		}
	}

	public function showModificarInstalacion(){
		if (isset($_SESSION["idUsuario"])) {
			$idInstalacion = $_REQUEST["idInstalacion"];
			$data['instalaciones'] = $this->instalaciones->get($idInstalacion);
			$this->vista->show('instalaciones/modificarInstalaciones', $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuario/formularioLogin", $data);
		}
	}

	public function modificarInstalacion(){
		if (isset($_SESSION["idUsuario"])) {

			$idInstalacion = $_REQUEST["idInstalacion"];
			$nombre = $_REQUEST["nombre"];
        	$descripcion = $_REQUEST["descripcion"];
        	$imagen = $_REQUEST["imagen"];
			$precio = $_REQUEST["precio"];

			// Lanzamos el UPDATE contra la base de datos.
			$result = $this->instalaciones->update($idInstalacion, $nombre, $descripcion, $imagen, $precio);

			if ($result != 1) {
				// Si la modificación de instalaciones ha fallado, mostramos un mensaje de error.
				$data['msjError'] = "Ha ocurrido un error al modificar la incidencia. Por favor, inténtelo más tarde.";
			}
			$data['listaIncidencias'] = $this->instalaciones->getAll();
			$this->vista->show("instalaciones/listaInstalaciones", $data);
		} else {
			$data['msjError'] = "No tienes permisos para hacer eso";
			$this->vista->show("usuarios/mostrarLogin", $data);
		}

	}

	public function confirmarEliminarInstalacion(){
		$idInstalacion = $_REQUEST['idInstalacion'];
		echo '<script>
			var opcion = confirm("¿Quieres eliminar la instalación?");
			if (opcion) {
				location.href="index.php?action=borrarInstalacion&idInstalacion='.$idInstalacion.'";
					location.href="index.php?action=mostrarListaInstalaciones"
				}else{
					location.href="index.php?action=mostrarListaInstalaciones"
				}
		</script>';
	}

	public function borrarInstalacion(){
		$idInstalacion = $_REQUEST['idInstalacion'];
		$result = $this->instalaciones->delete($idInstalacion);

		if ($result == 1) {
			$data['msjInfo'] = 'Instalación borrada con éxito';
		} else {
			$data['msjError'] = 'No se ha podido eliminar la instalación. Por favor inténtelo de nuevo más tarde';
		}
	}
}
