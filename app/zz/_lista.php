<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
	# code...
	ir('index.php');
}



$autorizados = array('ADMINISTRADOR', 'OPERADOR');
if (!in_array($_SESSION['usuario']['nivel'], $autorizados)) {
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

$miscampos  = array("id", "cargo");
$cantcampos = count($miscampos);

$n_datos            = bd_cargos_contar();
$n_datos_por_pagina = $config['paginacion']['num_items'];

if (isset($_REQUEST['pag'])) {
    $pagina_actual = $_REQUEST['pag'];
    $i             = $_REQUEST['i'];
} else {
    $pagina_actual = 1;
    $i             = 0;
}

if (isset($_REQUEST['p'])) {
    $datos = bd_cargos_datos21('id,cargo', $_REQUEST['p'], $n_datos_por_pagina);
} else {
    $datos = bd_cargos_datos2($i, $n_datos_por_pagina);
}

foreach ($miscampos as $campo) {
    $pos = strpos($campo, '_id');
    if ($pos > 0) {
        foreach ($datos as &$dato) {
            $indice        = substr($campo, 0, -3) . '_datos';
            $dato[$indice] = bd_datos($campo, $dato[$campo]);
        }
    }
}


$paginas = paginar($n_datos, $n_datos_por_pagina, $pagina_actual);

$smarty->assign('cab', '');
$smarty->assign('pie', '');

$smarty->assign('c', $miscampos);
$smarty->assign('n', $cantcampos);

$smarty->assign('datos', $datos);
$smarty->assign('paginas', $paginas);
$smarty->assign('pagina_actual', $pagina_actual);
$smarty->assign('n_paginas', count($paginas));

$smarty->assign('meta', proc_meta("cargos"));
$smarty->display("cargos_lista.html");
if ($config['debug']['debug'] == 'SI') {echo __FILE__;}
