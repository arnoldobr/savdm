<?php

/**
 * Devuelve un calendario en html para el año y el mes dado
 * (Use estilos para personalizarlo)
 *
 * @param $anyo (Integer) El año, ej. 2017.
 * @param $mes  (Integer) El mes, e.g. 7.
 * @param $eventos (Array) Un array de eventos donde la clave es la fecha del día
 * en el formato "Y-m-d", el valor es un array  'text' y 'link'.
 * @return (String) El html del calendario.
 */
function build_html_calendar($mes, $anyo, $eventos = null) {
	$meses=[
		'01'=>'Enero',
		'02'=>'Febrero',
		'03'=>'Marzo',
		'04'=>'Abril',
		'05'=>'Mayo',
		'06'=>'Junio',
		'07'=>'Julio',
		'08'=>'Agosto',
		'09'=>'Septiembre',
		'10'=>'Octubre',
		'11'=>'Noviembre',
		'12'=>'Diciembre'
	];

  // CSS classes
  $css_cal = 'table  table-bordered';
  $css_cal_row = 'calendar-row';
  $css_cal_day_head = 'calendar-day-head';
  $css_cal_day = 'calendar-day';
  $css_cal_day_number = 'day-number';
  $css_cal_day_blank = 'calendar-day-np';
  $css_cal_day_event = 'calendar-day-event';
  $css_cal_event = 'calendar-event';

  // Table headings
  $headings = ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá', 'Do'];

  // Start: draw table
  $calendar ="<h3>{$meses[$mes]} $anyo</h3>
  <table cellpadding='0' cellspacing='0' class='{$css_cal}'>
  	<tr class='{$css_cal_row}'>
  	<th class='{$css_cal_day_head}'>" .
    implode("</th>\n<th class='{$css_cal_day_head}'>", $headings) .
    "</th>" .
    "</tr>";

  // Days and weeks
  $running_day = date('N', mktime(0, 0, 0, $mes, 1, $anyo));
  $days_in_month = date('t', mktime(0, 0, 0, $mes, 1, $anyo));

  // Row for week one
  $calendar .= "\n<tr class='{$css_cal_row}'>";

  // Print "blank" days until the first of the current week
  for ($x = 1; $x < $running_day; $x++) {
    $calendar .= "\n\t<td class='{$css_cal_day_blank}'> </td>";
  }

  // Keep going with days...
  for ($day = 1; $day <= $days_in_month; $day++) {

    // Check if there is an event today
    $cur_date = date('Y-m-d', mktime(0, 0, 0, $mes, $day, $anyo));
    $draw_event = false;
    if (isset($eventos) && isset($eventos[$cur_date])) {
      $draw_event = true;
    }

    // Day cell
    $calendar .= $draw_event ?
      "\n\t<td class='{$css_cal_day} {$css_cal_day_event}'>" :
      "\n\t<td class='{$css_cal_day}'>";

    // Add the day number
    $calendar .= "\n\t<div class='{$css_cal_day_number}'>" . $day . "</div>";

    // Insert an event for this day
    if ($draw_event) {
      $calendar .=
        "<div class='{$css_cal_event}'>" .
        "<a href='{$eventos[$cur_date]['href']}'>" .
        $eventos[$cur_date]['text'] .
        "</a>" .
        "</div>";
    }

    // Close day cell
    $calendar .= "</td>";

    // New row
    if ($running_day == 7) {
      $calendar .= "</tr>";
      if (($day + 1) <= $days_in_month) {
        $calendar .= "\n<tr class='{$css_cal_row}'>";
      }
      $running_day = 1;
    }

    // Increment the running day
    else {
      $running_day++;
    }

  } // for $day

  // Finish the rest of the days in the week
  if ($running_day != 1) {
    for ($x = $running_day; $x <= 7; $x++) {
      $calendar .= "<td class='{$css_cal_day_blank}'> </td>";
    }
  }

  // Final row
  $calendar .= "</tr>";

  // End the table
  $calendar .= '</table>';

  // All done, return result
  return $calendar;
}



/**
 * Devuelve un array con los períodos desde la fecha hasta fin del mes
 * @param  int $a Año donde se van a crear los períodos
 * @param  int $m Mes desde donde se van a crear los períodos
 * @param  string $t Tipo de período: 'SEMANAL','QUINCENAL','MENSUAL','MENSUAL-CON-AD-QUINCENAL'
 * @return array    Períodos propuestos
 */
function lista_periodos($a, $m, $t){
	$n_dias_mes = cal_days_in_month(CAL_GREGORIAN,$m,$a);

	switch ($t) {
		case 'SEMANAL':
			$dia = 9 - date( 'N', strtotime("$a-$m-1") );
			$dia = $dia > 7 ? $dia - 7 : $dia;

			for ( $i = 0; $i < 5; $i++) {
				$dt = $dia + $i * 7;
				if ( checkdate($m,$dt,$a) ) {
					$df = $dt + 6;
					if ( $df <= $n_dias_mes) {
						$periodos[] = [ "$a-$m-$dt" , "$a-$m-$df" ];
					}else{
						$df -= $n_dias_mes;
						$mf = $m + 1;
						if ( $mf == 13 ) {
							$mf = 1;
							$af = $a + 1;
						}else{
							$af = $a;
						}
						$periodos[] = [ "$a-$m-$dt", "$af-$mf-$df" ];
					}
				}
			}
			break;
		case 'QUINCENAL':
		case 'MENSUAL-CON-AD-QUINCENAL':
			$periodos[] = [ "$a-$m-1" , "$a-$m-15" ];
			$periodos[] = [ "$a-$m-16" , "$a-$m-$n_dias_mes" ];
			break;
		case 'MENSUAL':
			$periodos[] = [ "$a-$m-1" , "$a-$m-$n_dias_mes" ];
			break;
		default:
			# code...
			break;
	}
	return($periodos);
}



function numlunes($f_inicio, $f_final){
	list( $ai , $mi , $di ) = explode( '-' , $f_inicio );
	list( $af , $mf , $df ) = explode( '-' , $f_final );

	$fi_unix = mktime( 0 , 0 , 0 , $mi , $di , $ai );
	$ff_unix = mktime( 0 , 0 , 0 , $mf , $df , $af );

	$num_lunes=0;

	for ($i = $fi_unix; $i <= $ff_unix; $i += 86400) {
		if ( date( 'w' , $i ) == 1 ) $num_lunes++;
	}

	return $num_lunes;
}


/**
 * Convierte Bs en céntimos
 * @param  float $bs Monto en Bolívares
 * @return int     Monto en céntimos
 */
function bs2cts($bs){
	$cts=$bs*100;
	return round($cts);
}

/**
 * Convierte céntimos en Bolívares
 * @param  int $cts Monto en céntimos
 * @return float      Monto en Bolívares con dos decimales
 */
function cts2bs($cts){
	return round($cts)/100.0;
}

function cts2bsf($cts){
	$bs=number_format(round($cts)/100.0, 2, ',', '.');
	return $bs;
}





function proc_meta($tabla) {
	$d      = parse_ini_file('./configs/campos.inc', true);
	$d      = $d[$tabla];
	$salida = array();
	foreach ($d['campo'] as $id => $campo) {
		$salida[$campo]['campo']    = $d['campo'][$id];
		$salida[$campo]['etiqueta'] = $d['etiqueta'][$id];
		$salida[$campo]['ayuda']    = $d['ayuda'][$id];
		$salida[$campo]['error']    = $d['error'][$id];
	}
	return $salida;
}

function f2f($fecha) {
	$fecha = ($fecha == "")?"00-00-0000":$fecha;
	list($d, $m, $a) = explode('-', $fecha);
	return "$a-$m-$d";
}

function ir($direccion) {
	header("Location: $direccion");
	exit();
}

function cadenaaleatoria($n = 10) {
	$letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
	$cadena = '';
	$nl     = strlen($letras);
	while ($n--) {
		$cadena .= $letras[mt_rand(0, $nl-1)];
	}
	return $cadena;
}

///////

function v() {
	echo <<<LRDTAB
<table border="1">
   <tr>
       <td>SESSION
       </td>
       <td>REQUEST
       </td>
   </tr>
   <tr>
       <td>
LRDTAB

	;

	ver($_SESSION);
	echo <<<LRDTAB
</td>
       <td>REQUEST
LRDTAB

	;

	ver($_REQUEST);
	echo <<<LRDTAB
</td>
   </tr>
    </table>
LRDTAB

	;
exit;
}

function s2hms($s) {
	$h = 0;
	$m = 0;
	while ($s >= 3600) {
		$h++;
		$s -= 3600;
	}
	while ($s >= 60) {
		$m++;
		$s -= 60;
	}

	$hms = str_pad($h, 2, '0', STR_PAD_LEFT)
	.':'.str_pad($m, 2, '0', STR_PAD_LEFT)
	.':'.str_pad($s, 2, '0', STR_PAD_LEFT);

	return array('h' => $h, 'm' => $m, 's' => $s, 'hms' => $hms);
}
















function ver2($matriz) {
	$estilo = 'style="background-color: rgba(100,100 ,100 , 0.2);font-size:8pt;font-family:arial;width:initial;"';
	$salida = '<table cellspacing="3" cellpadding="3" '.$estilo.'>';
	if (!is_array($matriz)) {
		var_dump($matriz);
		return $matriz;
	}
	foreach ($matriz as $key => $value) {
		if (count($value) > 0) {
			if (is_array($value) || is_object($value)) {
				$salida .= "<tr><th style=\"vertical-align: middle;text-align: right;\">$key :</th><td>";
				$salida .= ver2($value);
				$salida .= "</td></tr>";
			} else {
				$salida .= "<tr><th  style=\"vertical-align: middle;text-align: right;\">$key :</th><td>$value</td></tr>";
			}
		}
	}
	$salida .= '</table>';
	return $salida;
}

function ver(...$ss) {
	if (!(is_array($ss) || is_object($ss))) {
		echo $ss;
	} else {
		echo ver2($ss);
	}
}

function vq(...$a) {
	ver($a,debug_backtrace());
	exit;
}
