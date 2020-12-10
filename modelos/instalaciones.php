<?php
include_once("DB.php");
class Instalaciones
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
        $result = $this->db->consulta("SELECT * FROM instalacion
                                            WHERE idInstalacion = '$id'");
        return $result;
    }


    // Devuelve toda la lista de instalaciones. Si da algún error, devuelve null.
    public function getAll()
    {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM instalacion
					                        ORDER BY nombre");
        return $arrayResult;
    }

    //Inserta en la base de datos los datos de la instalacion

    public function insert($nombre, $descripcion, $imagen, $precio)
    {
        $nombre = $_REQUEST["nombre"];
        $descripcion = $_REQUEST["descripcion"];
        $imagen = $_REQUEST["imagen"];
        $precio = $_REQUEST["precio"];

        $result = $this->db->manipulacion("INSERT INTO instalacion (nombre, descripcion, imagen, precio) 
                        VALUES ('$nombre', '$descripcion', '$imagen', '$precio')");
        return $result;
    }

    //Modifica los datos si alguna vez fuera necesario a partir de una id.

    public function update($nombre, $descripcion, $imagen, $precio)
    {
        $idInstalacion = $_REQUEST["idInstalacion"];
        $nombre = $_REQUEST["nombre"];
        $descripcion = $_REQUEST["descripcion"];
        $imagen = $_REQUEST["imagen"];
        $precio = $_REQUEST["precio"];

        $result = $this->db->manipulacion("UPDATE instalacion SET
								nombre = '$nombre',
								descripcion = '$descripcion',
								imagen = '$imagen',
								precio = '$precio',
                                WHERE idInstalacion = '$idInstalacion'");
        return $result;
    }
    
    //Elimina datos de una instalacion a partir de su id.

    public function delete($idInstalacion)
    {
        $this->db->manipulacion("DELETE FROM instalacion WHERE idInstalacion = '$idInstalacion'");
        return $this->db->affected_rows;
    }


}
