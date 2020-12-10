<?php

include_once("modelos/seguridad.php");
include_once("modelos/reservas.php");

private $instalaciones, $reservas, $seguridad;

public function __construct(){
    $this->reservas = new Reservas();
    $this->seguridad = new Seguridad();
}

if ($this->seguridad->haySesionIniciada()) {
    echo "<p>Hola, ".$_SESSION['nombre']."</p>";
}

if (isset($data['msjError'])) {
    echo "<p style='color:red'>".$data['msjError']."</p>";
}
if (isset($data['msjInfo'])) {
    echo "<p style='color:blue'>".$data['msjInfo']."</p>";
}


if ($this->seguridad->haySesionIniciada()){
    echo "<form action='index.php'>
            <input type='hidden' name='action' value='buscarReserva'>
            Buscar:
            <input type='text' name='textoBusqueda' placeholder='Fecha, Hora o Precio' size='35'>
            <input type='submit' value='Buscar'>
        </form><br>";
}

if ($this->seguridad->haySesionIniciada()) {
    echo "<form action = 'index.php' method = 'get'>
        Ordenar por: 
        <select name='rolBusqueda'>
            <option value='fecha'>Fecha</option>
            <option value='hora'>Hora</option>
            <option value='precio'>Precio</option>
        </select>
        <input type='hidden' name='action' value='rolBusquedaReserva'>
        <input type='submit' value='Ordenar'>";
}
echo"<br>";
var_dump($data);

if (count($data['listaReservas']) > 0) {

    echo "<table border ='1'>";
        echo "<tr>";
            echo "<td>Lunes</td>";
            echo "<td>Martes</td>";
            echo "<td>Miercoles</td>";
            echo "<td>Jueves</td>";
            echo "<td>Viernes</td>";
            echo "<td>Sabado</td>";
            echo "<td>Domingo</td>";
        echo "</tr>";
        echo "<tr>";
        if($_SESSION['rol'] ==  "administrador"){
        $cont=01;
            while ($cont <= 31) {
                echo "<td>";
                echo "$cont <br>";
                foreach($data['listaReservas'] as $reservas) {
                    if($data['dia'] == $cont){
                        echo "<input id='instalacion".$reservas->idReserva."' type='hidden'>";
                        echo "fecha: ".$reservas->fecha."<br>";
                        echo "hora: ".$reservas->hora."<br>";
                        echo "precio: ".$reservas->precio."€/hora <br>";
                        if (isset($_SESSION["idReserva"])){
                            echo "<a href='index.php?action=formularioModificarReserva&idReserva=".$reservas->idReserva."'>Modificar</a><br>";
                            echo "<a href='#' class='btnBorrar' idReserva='".$reservas->idReserva."'>Borrar</a><br>";
                        } 
                        echo"-----------------------<br>";
                    }

                }
                
                if ($this->seguridad->haySesionIniciada()) {
                    echo "<p><a href='index.php?action=formularioInsertarReserva'>Nuevo</a></p>";
                }
                echo "</td>";
                if($cont % 7 == 0){echo "</tr><tr>";}
                $cont++;
            }
        }else if ($_SESSION['idReserva'] == $reservas->idReserva){
            $cont = 1;
            while ($cont <= 31) {
                echo "<td>";
                echo "$cont <br>";
                foreach($data['listaReservas'] as $reservas) {
                    if($data['dia'] == $cont){
                        echo "<input id='instalacion".$reservas->idReserva."' type='hidden'>";
                        echo "fecha: ".$reservas->fecha."<br>";
                        echo "hora: ".$reservas->hora."<br>";
                        echo "precio: ".$reservas->precio."€/hora <br>";
                        if (isset($_SESSION["idReserva"])){
                            echo "<a href='index.php?action=formularioModificarReserva&idReserva=".$reservas->idReserva."'>Modificar</a><br>";
                            echo "<a href='#' class='btnBorrar' idReserva='".$reservas->idReserva."'>Borrar</a><br>";
                        } 
                        echo"-----------------------<br>";
                    }

                }
                
                if ($this->seguridad->haySesionIniciada()) {
                    echo "<p><a href='index.php?action=formularioInsertarReserva'>Nuevo</a></p>";
                }
                echo "</td>";
                if($cont%7 == 0){echo "</tr><tr>";}
                $cont++;
            }
        }
    
    echo "</table>";
} 
else {
    
    echo "No se encontraron datos";
}


if ($this->seguridad->haySesionIniciada()) {
    echo "<p><a href='index.php?action=cerrarSesion'>Cerrar sesion</a></p>";
}
else {
    echo "<p><a href='index.php?action=mostrarLogin'>Iniciar sesion</a></p>";
}