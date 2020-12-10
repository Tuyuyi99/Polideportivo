<?php
include_once("DB.php");
class Usuario
{

    // Creamos un constructor donde iniciaremos nuestra conexión con la base de datos.
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }


    // Devuelve un usuario a partir de la id. Si no existe, devuelve null.
    public function get($id)
    {
        $result = $this->db->consulta($result = $this->db->consulta("SELECT * FROM usuario
                                            WHERE idUsuario = '$id'"));
        return $result;
    }


    // Devuelve toda la lista de usuario. Si da algún error, devuelve null.
    public function getAll()
    {
        $arrayResult = array();
        $result = $this->db->consulta("SELECT * FROM usuario
					                        ORDER BY apellido1");
        return $arrayResult;
    }

    //Inserta en la base de datos los datos del registro.

    public function insert($email, $contrasenia, $nombre, $apellido1, $apellido2, $dni, $imagen, $rol)
    {
        $email = $_REQUEST["email"];
        $contrasenia = $_REQUEST["contrasenia"];
        $nombre = $_REQUEST["nombre"];
        $apellido1 = $_REQUEST["apellido1"];
        $apellido2 = $_REQUEST["apellido2"];
        $dni = $_REQUEST["dni"];
        $imagen = $_REQUEST["imagen"];
        $rol = $_REQUEST["rol"];

        $result = $this->db->consulta("INSERT INTO usuario (email, contrasenia, nombre, apellido1, apellido2, dni, imagen, rol) 
                        VALUES ('$email', '$contrasenia', '$nombre', '$apellido1', '$apellido2', '$dni', '$imagen', '$rol')");
        return $result;
    }

    //Modifica los datos si alguna vez fuera necesario a partir de una id.

    public function update($email, $contrasenia, $nombre, $apellido1, $apellido2, $dni, $imagen, $rol)
    {
        $idUsuario = $_REQUEST["idUsuario"];
        $email = $_REQUEST["email"];
        $contrasenia = $_REQUEST["contrasenia"];
        $nombre = $_REQUEST["nombre"];
        $apellido1 = $_REQUEST["apellido1"];
        $apellido2 = $_REQUEST["apellido2"];
        $dni = $_REQUEST["dni"];
        $imagen = $_REQUEST["imagen"];
        $rol = $_REQUEST["rol"];

        $result = $this->db->manipulacion("UPDATE usuario SET
								email = '$email',
								contrasenia = '$contrasenia',
								nombre = '$nombre',
								apellido1 = '$apellido1'
                                apellido2 = '$apellido2'
                                dni = '$dni'
                                imagen = '$imagen'
                                rol = '$rol'
                                WHERE idUsuario = '$idUsuario'");
        return $result;
    }
    
    //Elimina datos de un usuario a partir de su id.

    public function delete($idUsuario)
    {
        $result = $this->db->manipulacion("DELETE FROM usuario WHERE idUsuario = '$idUsuario'");
        return $result;
    }

    //Buscamos un usuario a partir de su id y su nombre. Si lo encuentra, devolvemos true. Si no lo encuentra, devolvemos un false.

    public function existeNombre($nombreUsuario) {
        $result = $this->db->consulta("SELECT * FROM usuario WHERE email = '$email'");
        if ($result != null)
            return 1;
        else  
            return 0;

        }

        public function buscarUsuario($email,$contrasenia) {
            $result = $this->db->consulta("SELECT * FROM usuario WHERE email='$email' AND contrasenia='$contrasenia'");
            return $result;
        }
    }
