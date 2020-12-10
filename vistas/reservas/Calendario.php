<?php 

$mes = date("n");
    $mesSiguiente = $mes+1;
    if ($mesSiguiente == 13) {$mesSiguiente=1;}
    $anio = date("Y");
    $anioSiguiente = $anio;
    if ($mesSiguiente == 1) {$anioSiguiente+=1;}
    $diaActual = date("j");
    $diaSemana = date("w", mktime(0, 0, 0, $mes, 1, $anio)) + 7;
    $diaSemanaMesSiguiente = date("w", mktime(0, 0, 0, $mesSiguiente, 1, $anioSiguiente)) + 7;
    $ultimoDiaMes = date("d", (mktime(0, 0, 0, $mes + 1, 1, $anio) - 1));
    $ultimoDiaMesSiguiente = date("d", (mktime(0, 0, 0, $mesSiguiente + 1, 1, $anioSiguiente) - 1));
    $ultimoDiaMesSiguiente = date("d", (mktime(0, 0, 0, $mesSiguiente + 1, 1, $anioSiguiente) - 1));

    $meses = array('', "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $mesString = $meses[$mes];
    $mesSiguienteString = $meses[$mesSiguiente];
    


    echo '<div id="contenedor">';
    echo '<div id="mes1" style="display:none">'.$mes.'</div>';
    echo '<div id="mes2" style="display:none">'.$mesSiguiente.'</div>';
    echo '<table id="calendarios">
    <tr><td>';
    echo '<table id="calendar1">
        <div class="fechaCalendar1">'.$mesString.' '.$anio.'</div>
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
                            if (strlen($mes) == 1) {
                                $mes = '0'.$mes;
                            }
                            if (strlen($dia) == 1) {
                                $dia = '0'.$dia;
                            }
                            if ($dia == substr($reserva->fecha, -2) && $mes == substr($reserva->fecha, 5,2) && !in_array(substr($reserva->fecha, -2), $reservasEscritas)) {
                                $reservasEscritas[] = substr($reserva->fecha, -2);
                                echo '<div class="diaConReserva" onmouseover="mostrar_reservas_en_calendario_mes1('.$dia.','.$mes.')">';
                            }
                        }
                    }
                    echo '<a href="index.php?action=mostrarReservas&idUsuario='.$_SESSION['idUsuario'].'&dia='.$dia.'&mes='.$mes.'">'.$dia.'</div></td>';

                    
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
        <div class="fechaCalendar2">'.$mesSiguienteString.' '.$anioSiguiente.'</div>
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
