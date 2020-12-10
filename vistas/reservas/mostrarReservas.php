
<?php

//TODO MENU 
if($_SESSION['rol'] ==  "administrador"){
    echo "<p><h1><a href='index.php?action=mostrarReservas'>Reservas</a> | 
    <a href='index.php?action=mostrarUsuarios'>Usuarios</a> | 
    <a href='index.php?action=mostrarInstalaciones'>Instalaciones</a></h1></p>";
}else{
    echo "<p><a href='index.php?action=mostrarInstalaciones'><h1>Instalaciones</h1></a></p>";
}
// Mostramos info del usuario logueado (si hay alguno)
if ($this->seguridad->haySesionIniciada()) {
    echo "<p>Hola, ".$_SESSION['nombre']."</p>";
}
// Mostramos mensaje de error o de informacion (si hay alguno)
if (isset($data['msjError'])) {
    echo "<p style='color:red'>".$data['msjError']."</p>";
}
if (isset($data['msjInfo'])) {
    echo "<p style='color:blue'>".$data['msjInfo']."</p>";
}

// Primero, el formulario de busqueda
if ($this->seguridad->haySesionIniciada()){
    echo "<form action='index.php'>
            <input type='hidden' name='action' value='buscarReserva'>
            BUSCAR POR:
            <input type='text' name='textoBusqueda' placeholder='fecha, hora o precio' size='30'>
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
    // Ahora, la tabla con los datos de los libros
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
                // El boton "Nueva reserva" solo se muestra si hay una sesion iniciada
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
                // El boton "Nueva reserva" solo se muestra si hay una sesion iniciada
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
    // La consulta no contiene registros
    echo "No se encontraron datos";
}

// Enlace a "Iniciar sesion" o "Cerrar sesion"
if ($this->seguridad->haySesionIniciada()) {
    echo "<p><a href='index.php?action=cerrarSesion'>Cerrar sesion</a></p>";
}
else {
    echo "<p><a href='index.php?action=mostrarLogin'>Iniciar sesion</a></p>";
}