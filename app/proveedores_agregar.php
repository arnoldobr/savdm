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

$f_meta = proc_meta("cargos");

$f = new FormHandler('cargos', null, 'role="form"  class="form-group"');
$f->useTable(false);
$f->setMask($config['mascaras']['m1'], true);

$f->textField($f_meta['cargo']['etiqueta'], 'cargo', FH_STRING);
$f->setErrorMessage('cargo', $f_meta['cargo']['error']);
$f->setHelpText('cargo', $f_meta['cargo']['ayuda']);

$f->submitButton('Continuar', 'botonSubmit');
$f->onCorrect('proc_cargos_agregar');

function proc_cargos_agregar($d)
{

    bd_cargos_agregar($d);
    ir('mensajev.php?mensaje=cargo agregado a la Base de Datos correctamente');
}

$smarty->assign('cab', '');
$smarty->assign('pie', '');
$smarty->assign('f', $f->flush(true));
$smarty->display("cargos_agregar.html");

if ($config['debug']['debug'] == 'SI') {
    echo __FILE__;
}
