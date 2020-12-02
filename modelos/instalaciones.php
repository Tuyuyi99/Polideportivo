<?php
class usuario
{

    // Creamos un constructor donde iniciaremos nuestra conexión con la base de datos.
    private $db;
    public function __construct()
    {
        $this->db = new mysqli("localhost", "pablodelacuesta", "P*blo99@", "incidencias");
    }

    // Devuelve un usuario a partir de la id. Si no existe, devuelve null.
    public function get($id)
    {
        $result = $this->db->consulta("SELECT * FROM usuario
                                            WHERE idUsuario = '$id'")
        return $result;
    }


    // Devuelve toda la lista de usuario. Si da algún error, devuelve null.
    public function getAll()
    {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM usuario
					                        ORDER BY apellidos")
        return $arrayResult;
    }

    //Inserta en la base de datos los datos del registro.

    public function insert($nombre, $apellidos, $email, $usuario, $contrasenia)
    {
        $result = $this->db->manipulacion("INSERT INTO usuario (nombre, apellidos, email, usuario, contrasenia) 
                        VALUES ('$nombre', '$apellidos', '$email', '$usuario', '$contrasenia')");
        return $result;
    }

    //Modifica los datos si alguna vez fuera necesario a partir de una id.

    public function update($nombre, $apellidos, $email, $usuario, $contrasenia)
    {
        $result = $this->db->manipulacion("UPDATE usuario SET
								nombre = '$nombre',
								apellidos = '$apellidos',
								email = '$email',
								usuario = '$usuario',
								contrasenia = '$contrasenia'
                                WHERE idUsuario = '$idUsuario'");
        return $result
    }
    
    //Elimina datos de un usuario a partir de su id.

    public function delete($idUsuario)
    {
        $this->db->manipulacion("DELETE FROM usuario WHERE idUsuario = '$idUsuario'");
        return $this->db->affected_rows;
    }


}
