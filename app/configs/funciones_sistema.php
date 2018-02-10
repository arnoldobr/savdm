<?php

function parentesis_balanceados( $s ) {
    $bal = 0;
    for ($i=0; $i < strlen($s); $i++) {
        $ch = substr($s, $i, 1);
        if ($ch == '(') {
            $bal++;
        } else {
            $bal--;
        }
        if ($bal < 0) return false;
    }
    return ($bal == 0);
}

function validar_formula($formula){
	$formula = preg_replace('/\s+/', '', $formula);

	$variables  = [
		'$NR',		# Número de repeticiones (Si no existe se asume como 1)
		'$SUELDO',	# Sueldo del período
		'$NL',		# Número de lunes
		'$SD',		# Salario Diario
		'$SS',		# Salario Semanal
		'$SQ',		# Salario Quincenal
		'$SM'		# Salario Mensual
	];

	$funciones  = ['abs','ceil','floor','round','pow']; // Funciones de php admitidas
	$operadores = ['+','-','*','/','%',]; // Operadores matemáticos
	$numeros    = ['0','1','2','3','4','5','6','7','8','9','.',',']; //dígitos
	
	$formula=str_replace($variables,'',$formula);
	$formula=str_replace($funciones,'',$formula);
	$formula=str_replace($operadores,'',$formula);
	$formula=str_replace($numeros,'',$formula);
	if(parentesis_balanceados($formula) ){
		return true;
	}
	return false;
}


function prueba_evaluar($formula, $d){
	echo '<pre>';
	print_r([
		'Fórmula'=>$formula,
		'$d'=>$d,
		'Valor'=> round(evaluar($formula,$d)) ]);
}


function evaluar($formula,$d){
	if (validar_formula($formula)){
		$formula = preg_replace('/\s+/', '', $formula);
		extract($d);
		$NR=isset($NR)?$NR:1;
		eval('$resultado = '.$formula.';');	
	}else{
		$resultado=-1;//Error en la fórmula
	}
	return $resultado;
}


function paginar($totalpaginas,$rango,$pagina_actual=1){
	$i       = 0;
	$rgo     = $rango;
	$paginas = array();

	do{
		$paginas[] = $i;
		$i+=$rgo;
	}while ( $i < $totalpaginas);

	return $paginas;
}



function pdf_constancia_trabajo($id){
	list($dia, $mes, $anyo)=explode('-', date("d-n-Y") );
	$alos = ($dia == 1) ? 'el' : 'a los';
	$mdia=($dia == 1) ? 'día' : 'días';
	$dia_l=['',
		'primer', 'dos', 'tres', 'cuatro', 'cinco',
		'seis', 'siete', 'ocho', 'nueve', 'diez',
		'once', 'doce', 'trece', 'catorce', 'quince',
		'dieciseis', 'diecisiete', 'dieciocho', 'diecinueve', 'veinte',
		'veintiún', 'veintidós', 'veintitrés', 'veinticuatro', 'veinticinco',
		'veintiseis', 'veintisiete', 'veintiocho', 'veintinueve', 'treinta',
		'treinta y un'];

	$meses=['',
		'Enero', 'Febrero', 'Marzo',
		'Abril', 'Mayo', 'Junio',
		'Julio', 'Agosto', 'Septiembre',
		'Octubre', 'Noviembre', 'Diciembre'
	];

	$d=bd_empleados_datos($id);
	$empresa=bd_variables();
	$d['cargo']=bd_cargos_dato($d['cargo_id'],'cargo')['cargo'];
	$d['salario']=bd_salarios_dato($d['cargo_id'], 'salario_mensual')['salario_mensual']/100;
	$texto_constancia = <<<LRDTAB
{$empresa['nombre']}
{$empresa['rif']}
Por medio de la presente se hace constar que el cidudano {$d['nombre']} {$d['apellido']}, portador de la Cédula de Identidad N°: {$d['id']} trabaja en esta Empresa desde el {$d['f_ingreso']} desmpeñando el cargo de {$d['cargo']} devengando un salario mensual de {$d['salario']}.
Constancia que se expide a petición de parte interesada, en {$empresa['ciudad']}, $alos {$dia_l[$dia]} ($dia) $mdia del mes de {$meses[$mes]} del año $anyo.
{$empresa['nombre_constancia']}
{$empresa['cargo_constancia']}
LRDTAB;

	ver($d);
	vq($texto_constancia);
}