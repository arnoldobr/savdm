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

$id=$_REQUEST['id'];

$d=bd_cargos_datos($id);

$f_meta = proc_meta("cargos");

$f = new FormHandler('cargos', null, 'role="form"  class="form-group"');
$f->setLanguage( 'es' );

$f->useTable(false);
$f->setMask($config['mascaras']['m1'], true);

$f->textField($f_meta['id']['etiqueta'], 'id0', FH_INTEGER, 11, 11);
$f->setValue('id0',$d['id']);
$f->setFieldViewMode('id0');

$f->hiddenField('id',$d['id']);

$f->textField($f_meta['cargo']['etiqueta'], 'cargo', FH_STRING);
$f->setErrorMessage('cargo', $f_meta['cargo']['error']);
$f->setHelpText('cargo', $f_meta['cargo']['ayuda']);
$f->setValue('cargo',$d['cargo']);

$f->submitButton('Continuar', 'botonSubmit');
$f->onCorrect('proc_cargos_modificar');

function proc_cargos_modificar($d){
    $d['f_ingreso']=f2f($d['f_ingreso']);
    $d['f_vence']=f2f($d['f_vence']);
    $d['salario']*=100;
    bd_cargos_modificar($d);
    ir('mensajev.php?mensaje=cargo modificado correctamente');
}

$smarty->assign('cab', '');
$smarty->assign('pie', '');
$smarty->assign('f', $f->flush(true));
$smarty->display("cargos_modificar.html");

if ($config['debug']['debug'] == 'SI') {echo __FILE__; }
