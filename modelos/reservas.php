<?php
include_once("DB.php");
class Reservas
{

    // Creamos un constructor donde iniciaremos nuestra conexión con la base de datos.
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    // Devuelve una instalacion a partir de la id. Si no existe, devuelve null.
    public function get($id)
    {
        $result = $this->db->consulta("SELECT * FROM reserva
                                            WHERE idReserva = '$id'");
        return $result;
    }


    // Devuelve toda la lista de instalaciones. Si da algún error, devuelve null.
    public function getAll()
    {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM reserva
					                        ORDER BY fecha");
        return $arrayResult;
    }

    public function getSelected($idUsuario) {
        $result = $this->db->consulta("SELECT * FROM reserva WHERE idUsuario = '$idUsuario'");

        return $result;
    }

    //Inserta en la base de datos los datos de la instalacion

    public function insert($fecha, $hora, $precio)
    {
        $fecha = $_REQUEST["fecha"];
        $hora = $_REQUEST["hora"];
        $precio = $_REQUEST["precio"];

        $result = $this->db->manipulacion("INSERT INTO reserva (fecha, hora, precio) 
                        VALUES ('$fecha', '$hora', '$precio')");
        return $result;
    }

    //Modifica los datos si alguna vez fuera necesario a partir de una id.

    public function update($fecha, $hora, $precio)
    {
        $idReserva = $_REQUEST["idReserva"];
        $fecha = $_REQUEST["fecha"];
        $hora = $_REQUEST["hora"];
        $precio = $_REQUEST["precio"];

        $result = $this->db->manipulacion("UPDATE reserva SET
								fecha = '$fecha',
								hora = '$hora',
								precio = '$precio',
                                WHERE idReserva = '$idReserva'");
        return $result;
    }
    
    //Elimina datos de una instalacion a partir de su id.

    public function delete($idReserva)
    {
        $this->db->manipulacion("DELETE FROM reserva WHERE idReserva = '$idReserva'");
        return $this->db->affected_rows;
    }


}