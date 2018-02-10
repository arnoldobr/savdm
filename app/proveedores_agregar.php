<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {	ir('index.php'); }


if (!in_array($_SESSION['usuario']['nivel'],
	['ADMINISTRADOR', 'OPERADOR']
)) {
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

$f_meta = proc_meta("proveedores");

$f = new FormHandler('proveedores', null, 'role="form"  class="form-group"');
$f->useTable(false);
$f->setMask($config['mascaras']['mh'], true);

$f->textField($f_meta['nombre']['etiqueta'], 'nombre', FH_STRING);
$f->setErrorMessage('nombre', $f_meta['nombre']['error']);
$f->setHelpText('nombre', $f_meta['nombre']['ayuda']);

$f->textField($f_meta['apodo']['etiqueta'], 'apodo', FH_STRING);
$f->setErrorMessage('apodo', $f_meta['apodo']['error']);
$f->setHelpText('apodo', $f_meta['apodo']['ayuda']);

$f->textField($f_meta['ubicacion']['etiqueta'], 'ubicacion', FH_STRING);
$f->setErrorMessage('ubicacion', $f_meta['ubicacion']['error']);
$f->setHelpText('ubicacion', $f_meta['ubicacion']['ayuda']);

$intermediarios=bd_intermediarios_opciones();
$f->selectField($f_meta['intermediario_id']['etiqueta'], 'intermediario_id',
$intermediarios, FH_STRING);
$f->setErrorMessage('intermediario_id', $f_meta['intermediario_id']['error']);
$f->setHelpText('intermediario_id', $f_meta['intermediario_id']['ayuda']);

$productos = bd_productos_opciones();
$f->checkBox($f_meta['productos']['etiqueta'], 'productos',$productos,null, false,'',' ');
$f->setErrorMessage('productos', $f_meta['productos']['error']);
$f->setHelpText('productos', $f_meta['productos']['ayuda']);

$f->submitButton('Continuar', 'botonSubmit');
$f->onCorrect('proc_proveedores_agregar');

function proc_proveedores_agregar($d)
{
    bd_proveedores_agregar($d);
    ir('mensajev.php?mensaje=proveedor agregado a la Base de Datos correctamente');
}

$smarty->assign('cab', '');
$smarty->assign('pie', '');
$smarty->assign('f', $f->flush(true));
$smarty->display("proveedores_agregar.html");

if ($config['debug']['debug'] == 'SI') { echo __FILE__;}
