<?php
class incidencia
{

    // Creamos un constructor donde iniciaremos nuestra conexión con la base de datos.
    private $db;
    public function __construct()
    {
        $this->db = new mysqli("localhost", "pablodelacuesta", "P*blo99@", "incidencias");
    }

    // Devuelve una incidencia a partir de la id. Si no existe, devuelve null.

    public function get($id){
        if ($result = $this->db->query("SELECT * FROM incidencia
                                            WHERE idIncidencia = '$id'")) {
            $result = $result->fetch_object();
        } else {
            $result = null;
        }
        return $result;
    }


    // Devuelve toda la lista de incidencias. Si da algún error, devuelve null.
    public function getAll(){
        $arrayResult = array();
        if ($result = $this->db->query("SELECT * FROM incidencia WHERE idUsuario = '".$_SESSION["idUsuario"]."' ORDER BY equipo")) {
            while ($fila = $result->fetch_object()) {
                $arrayResult[] = $fila;
            }
        } else {
            $arrayResult = null;
        }
        return $arrayResult;
    }

    public function getAllAdmin(){
        $arrayResult = array();
        if ($result = $this->db->query("SELECT * FROM incidencia ORDER BY equipo")) {
            while ($fila = $result->fetch_object()) {
                $arrayResult[] = $fila;
            }
        } else {
            $arrayResult = null;
        }
        return $arrayResult;
    }

    //Inserta en la base de datos los datos de la incidencia

    public function insert($equipo, $fecha, $lugar, $descripcion, $observaciones, $estado){
        $idUsuario = $_SESSION["idUsuario"];
        $this->db->query("INSERT INTO incidencia (equipo, fecha, lugar, descripcion, observaciones, estado, idUsuario) 
                        VALUES ('$equipo', '$fecha', '$lugar', '$descripcion', '$observaciones', '$estado', '$idUsuario')");
        return $this->db->affected_rows;
    }

    //Modifica los datos si alguna vez fuera necesario a partir de una id.


    public function update($idIncidencia, $equipo, $fecha, $lugar, $descripcion, $observaciones, $estado){
        $this->db->query("UPDATE incidencia SET
								equipo = '$equipo',
								fecha = '$fecha',
								lugar = '$lugar',
								descripcion = '$descripcion',
								observaciones = '$observaciones',
                                estado = '$estado'
                                WHERE idIncidencia = '$idIncidencia'");
        return $this->db->affected_rows;
    }
    
    //Elimina una incidencia a partir de su id.

    public function delete($idIncidencia){
        $this->db->query("DELETE FROM incidencia WHERE idIncidencia = '$idIncidencia'");
        return $this->db->affected_rows;
    }


}