<?php
include 'inicializacion.php';

if(!in_array($_SESSION['usuario']['nivel'],['ADMINISTRADOR','OPERADOR'])){
	ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
	exit;
}

if (!isset($_REQUEST['id'])) ir('intermediaris_lista.php');

$id    = $_REQUEST['id'];
$datos = bd_intermediarios_datos($id);

$f_meta=proc_meta("intermediarios");

$f = new FormHandler('intermediarios');
$f -> useTable( False );
$f -> setMask($config['mascaras']['m1'],true);


$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 100 );
//$f->textField( $f_meta['telefono']['etiqueta'], 'telefono', FH_STRING, 50, 500 );
//$f->textArea( $f_meta['direccion']['etiqueta'], 'direccion', FH_TEXT, 65, 3, 'class="ckeditor" style="width: 712px;"');
//$f->selectField( $f_meta['intermediario_id']['etiqueta'], 'intermediario_id', bd_intermediarios_opciones() );

$f->setErrorMessage('nombre','');
/*$f->setErrorMessage('telefono','');
$f->setErrorMessage('direccion','');
$f->setErrorMessage('intermediario_id','');*/

$f->setHelpText('nombre', '');
/*$f->setHelpText('telefono', '');
$f->setHelpText('direccion', 'Esciba su Dirección');
$f->setHelpText('intermediario_id', '');*/

$f->setValue('nombre',$datos['nombre']);
/*$f->setValue('telefono',$datos['telefono']);
$f->setValue('direccion',$datos['direccion']);
$f->setValue('intermediario_id',$datos['intermediario_id']);*/

$f -> submitButton('Continuar','botonSubmit');

$f -> onCorrect('proc_intermediarios_modificar');

function proc_intermediarios_modificar($d)
{


	$d['id'] = $_REQUEST['id'];
	bd_intermediarios_modificar($d);
    ir('mensajev.php?mensaje=Datos del Intermediario modificados correctamente');
}

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->assign('f',$f->flush(true));
$smarty->display('intermediarios_modificar.html');
if ($config['debug']['debug']=='SI') {echo __FILE__;}
