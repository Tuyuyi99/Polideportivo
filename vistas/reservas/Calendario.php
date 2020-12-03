<?php
$diaSemana = date("w");
if ($diaSemana == 0) $diaSemana = 7;
$diaMes = date("j");
$mes = date("n");

echo "Dia de la semana: $diaSemana, Dia del mes: $diaMes, Mes: $mes";

$r = $diaMes % 7; 
$r2 = $diaSemana - $r;
if ($r2 < 1){
	$r2 += 7;
}
echo "<table border='1'>";
for ($semana = 1; $semana <= 6; $semana++){
	echo "<tr>";
	for ($diaS = 1; $diaS < 7; $diaS++){
		if ($semana == 1 && $diaSemanaEmpiezaMes = $diaS){
			$cont = 1;
		}
		if ($cont > 0){
			echo "<td>$cont</td>";
		}
		}
		echo "<td>-</td>";

	}
	echo "</tr>";
echo "</table>";
?>