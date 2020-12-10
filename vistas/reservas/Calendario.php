<?php 

$month = date("n");
    $mesSiguiente = $month+1;
    if ($mesSiguiente == 13) {$mesSiguiente=1;}
    $year = date("Y");
    $yearSiguiente = $year;
    if ($mesSiguiente == 1) {$yearSiguiente+=1;}
    $diaActual = date("j");
    $diaSemana = date("w", mktime(0, 0, 0, $month, 1, $year)) + 7;
    $diaSemanaMesSiguiente = date("w", mktime(0, 0, 0, $mesSiguiente, 1, $yearSiguiente)) + 7;
    $ultimoDiaMes = date("d", (mktime(0, 0, 0, $month + 1, 1, $year) - 1));
    $ultimoDiaMesSiguiente = date("d", (mktime(0, 0, 0, $mesSiguiente + 1, 1, $yearSiguiente) - 1));
    $ultimoDiaMesSiguiente = date("d", (mktime(0, 0, 0, $mesSiguiente + 1, 1, $yearSiguiente) - 1));

    $meses = array('', "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $monthString = $meses[$month];
    $mesSiguienteString = $meses[$mesSiguiente];
    


    echo '<div id="contenedor">';
    echo '<div id="mes1" style="display:none">'.$month.'</div>';
    echo '<div id="mes2" style="display:none">'.$mesSiguiente.'</div>';
    echo '<table id="calendarios">
    <tr><td>';
    echo '<table id="calendar1">
        <div class="fechaCalendar1">'.$monthString.' '.$year.'</div>
        <tr>
            <th>L</th><th>M</th><th>X</th><th>J</th>
            <th>V</th><th>S</th><th>D</th>
        </tr>
        <tr>';
            $ultimaCelda = $diaSemana + $ultimoDiaMes;
            for ($i = 1; $i <= 42; $i++) {
                if ($i == $diaSemana) {

                    $dia = 1;
                }
                if ($i < $diaSemana || $i >= $ultimaCelda) {

                    echo "<td>&nbsp;</td>";
                } else {

                    if ($dia == $diaActual) {
                        echo "<td class='hoy'>";
                    } else {
                        echo "<td>";
                    }
                    if (is_array($data['listaReservas'])) {
                        $reservasEscritas = array();
                        foreach($data['listaReservas'] as $reserva) {
                            $diaFecha = substr($reserva->fecha, -2);
                            $mesFecha = substr($reserva->fecha, 6,7);
                            if (strlen($month) == 1) {
                                $month = '0'.$month;
                            }
                            if (strlen($dia) == 1) {
                                $dia = '0'.$dia;
                            }
                            if ($dia == substr($reserva->fecha, -2) && $month == substr($reserva->fecha, 5,2) && !in_array(substr($reserva->fecha, -2), $reservasEscritas)) {
                                $reservasEscritas[] = substr($reserva->fecha, -2);
                                echo '<div class="diaConReserva" onmouseover="mostrar_reservas_en_calendario_mes1('.$dia.','.$month.')">';
                            }
                        }
                    }
                    echo '<a href="index.php?action=mostrarReservas&idUsuario='.$_SESSION['idUsuario'].'&dia='.$dia.'&mes='.$month.'">'.$dia.'</div></td>';

                    
                    $dia++;
                }

                if ($i % 7 == 0) {

                    echo "</tr><tr>\n";
                }
            }

        echo '</tr>
    </table>
    </td><td></td>';

    echo '
    <td>
    <table id="calendar2">
        <div class="fechaCalendar2">'.$mesSiguienteString.' '.$yearSiguiente.'</div>
        <tr>
            <th>L</th><th>M</th><th>X</th><th>J</th>
            <th>V</th><th>S</th><th>D</th>
        </tr>
        <tr>';
        $ultimaCelda = $diaSemanaMesSiguiente + $ultimoDiaMesSiguiente;
        for ($i = 1; $i <= 42; $i++) {
            if ($i == $diaSemanaMesSiguiente) {

                $dia = 1;
            }
            if ($i < $diaSemanaMesSiguiente || $i >= $ultimaCelda) {

                echo "<td>&nbsp;";
            } else {

                echo "<td>";
                    if (is_array($data['listaReservas'])) {
                        $reservasEscritas = array();
                        foreach($data['listaReservas'] as $reserva) {
                            $diaFecha = substr($reserva->fecha, -2);
                            $mesFecha = substr($reserva->fecha, 6,7);
                            if (strlen($mesSiguiente) == 1) {
                                $mesSiguiente = '0'.$mesSiguiente;
                            }
                            if (strlen($dia) == 1) {
                                $dia = '0'.$dia;
                            }
                            if ($dia == substr($reserva->fecha, -2) && $mesSiguiente == substr($reserva->fecha, 5,2)) {
                                echo '<div class="diaConReserva" onmouseover="mostrar_reservas_en_calendario_mes1('.$dia.','.$mesSiguiente.')">';
                            }
                        }
                    }
                echo '<a href="index.php?action=mostrarReservas&idUsuario='.$_SESSION['idUsuario'].'&dia='.$dia.'&mes='.$mesSiguiente.'">'.$dia.'</div></td>';
            }
            $dia++;

            if ($i % 7 == 0) {

                echo "</tr><tr>\n";
            }
        }
        echo '</tr>';
    
    echo '</table>
    </td></tr></table>';
