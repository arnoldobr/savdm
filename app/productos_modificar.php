<?php
include 'inicializacion.php';

if(!in_array($_SESSION['usuario']['nivel'],['ADMINISTRADOR','OPERADOR'])){
	ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
	exit;
}

if (!isset($_REQUEST['id'])) ir('productos_lista.php');

$id    = $_REQUEST['id'];
$datos = bd_productos_datos($id);

$f_meta=proc_meta("productos");

$f = new FormHandler('productos');
$f -> useTable( False );
$f -> setMask($config['mascaras']['m1'],true);


$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 100 );
$f->textField( $f_meta['unidadcompra']['etiqueta'], 'unidadcompra', FH_STRING, 50, 500 );

$f->setErrorMessage('nombre','');
$f->setErrorMessage('unidadcompra','');

$f->setHelpText('nombre', '');
$f->setHelpText('unidadcompra', 'Escriba la Unidad de compra');
$f->setHelpText('direccion', 'Esciba su Dirección');
$f->setHelpText('intermediario_id', '');

$f->setValue('nombre',$datos['nombre']);
$f->setValue('unidadcompra',$datos['unidadcompra']);

$f -> submitButton('Continuar','botonSubmit');

$f -> onCorrect('proc_productos_modificar');

function proc_productos_modificar($d)
{


	$d['id'] = $_REQUEST['id'];
	bd_productos_modificar($d);
    ir('mensajev.php?mensaje=Datos del Producto modificados correctamente');
}

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->assign('f',$f->flush(true));
$smarty->display('productos_modificar.html');
if ($config['debug']['debug']=='SI') {echo __FILE__;}
