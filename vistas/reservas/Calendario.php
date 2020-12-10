<?php $month = date("n");
    $year = date("Y");
    $diaActual = date("j");
    $diaSemana = date("w", mktime(0, 0, 0, $month, 1, $year)) + 7;
    $ultimoDiaMes = date("d", (mktime(0, 0, 0, $month + 1, 1, $year) - 1));

    $meses = array(1 => "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");


            echo "<p><a href='index.php?action=showInsertarReserva&idUsuario'>Nueva Reserva</a></p>";


    ?>

            <table id="calendar">

                <caption><?php echo $meses[$month] . " " . $year ?></caption>
                <tr>
                    <th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
                    <th>Vie</th><th>Sab</th><th>Dom</th>
                </tr>
                <tr bgcolor="silver">

                    <?php
                    $last_cell = $diaSemana + $ultimoDiaMes;

                    for ($i = 1; $i <= 42; $i++) {

                        if ($i == $diaSemana) {

                            // determinamos en que dia empieza
                            $day = 1;
                        }

                        if ($i < $diaSemana || $i >= $last_cell) {

                            // celca vacia
                            echo "<td>&nbsp;</td>";
                        } else {

                            // mostramos el dia
                            if ($day == $diaActual)
                                echo "<td class='hoy'><a href = '../../Controlador/controlador.php?dia=''' class='btn btn-light' name = 'dia' id = 'dia' > ".$day."</a></td>";

                            else
                                echo "<td>$day</td>";

                            $day++;
                        }
                        

                        // cuando llega al final de la semana, iniciamos una columna nueva

                        if ($i % 7 == 0) {

                            echo "</tr><tr>\n";
                        }
                    }
                    ?>

                </tr>

            </table>
            