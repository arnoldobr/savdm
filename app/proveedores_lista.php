<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
	# code...
	ir('index.php');
}



if (!in_array($_SESSION['usuario']['nivel'],
    [
        'ADMINISTRADOR', 'OPERADOR'
    ]
)) {
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

$miscampos  = array("id", "nombre", "apodo", "ubicacion", "intermediario_id");
$cantcampos = count($miscampos);

$n_datos            = bd_proveedores_contar();
$n_datos_por_pagina = $config['paginacion']['num_items'];

if (isset($_REQUEST['pag'])) {
    $pagina_actual = $_REQUEST['pag'];
    $i             = $_REQUEST['i'];
} else {
    $pagina_actual = 1;
    $i             = 0;
}

if (isset($_REQUEST['p'])) {
    $datos = bd_proveedores_datos21("id, nombre, apodo, ubicacion, intermediario_id", $_REQUEST['p'], $n_datos_por_pagina);
} else {
    $datos = bd_proveedores_datos2($i, $n_datos_por_pagina);
}

foreach ($datos as &$d) {
    $d['intermediario'] = bd_intermediarios_dato($d['intermediario_id'], 'nombre')['nombre'];
    $d['productos']=bd_productosxproveedor($d['id']);
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

$smarty->assign('meta', proc_meta("proveedores"));
$smarty->display("proveedores_lista.html");
if ($config['debug']['debug'] == 'SI') {echo __FILE__;}
