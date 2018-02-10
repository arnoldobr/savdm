<?php
$config=parse_ini_file('./configs/config.inc',true);
session_name('nomina');
session_start();
include('./configs/bd.php');
include('./configs/funciones_sistema.php');
include('./configs/fh3.php');
include('./configs/funciones.php');
include('./configs/smarty.php');
include('./configs/validacion.php');
include('./modelo/bd_modelo.php');

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
	ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
	exit;
}

if (!isset($_REQUEST['id'])) ir('usuarios_lista.php');

$f_meta=proc_meta("usuarios");

$id    = $_REQUEST['id'];
$datos = bd_usuarios_datos($id);

$f = new FormHandler('usuarios');
$f -> useTable( False );
$f -> setMask($config['mascaras']['m1'],true);
$f->setLanguage( 'es' );
$f -> borderStart('Usuarios');

$f->textField( $f_meta['id']['etiqueta'], 'id', FH_STRING, 32, 32 );
$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 255 );
$f->selectField( $f_meta['nivel']['etiqueta'], 'nivel', array('ADMINISTRADOR','OPERADOR','TRABAJADOR'), FH_STRING, false );
$f->textField( $f_meta['email']['etiqueta'], 'email', FH_STRING, 50, 255 );
$f->selectField( $f_meta['activo']['etiqueta'], 'activo', array('NO','SI','',''), FH_STRING, false );

$f->setErrorMessage('id',$f_meta['id']['error']);
$f->setErrorMessage('nombre',$f_meta['nombre']['error']);
$f->setErrorMessage('nivel',$f_meta['nivel']['error']);
$f->setErrorMessage('email',$f_meta['email']['error']);
$f->setErrorMessage('activo',$f_meta['activo']['error']);

$f->setHelpText('id', $f_meta['id']['ayuda']);
$f->setHelpText('nombre', $f_meta['nombre']['ayuda']);
$f->setHelpText('nivel', $f_meta['nivel']['ayuda']);
$f->setHelpText('email', $f_meta['email']['ayuda']);
$f->setHelpText('activo', $f_meta['activo']['ayuda']);

$f->setValue('id',$datos['id']);
$f->setValue('nombre',$datos['nombre']);
$f->setValue('nivel',$datos['nivel']);
$f->setValue('email',$datos['email']);
$f->setValue('activo',$datos['activo']);

$f -> submitButton('Continuar','botonSubmit');
$f -> borderStop();
$f -> onCorrect('proc_usuarios_modificar');

function proc_usuarios_modificar($d)
{


	$d['id'] = $_REQUEST['id'];
	bd_usuarios_modificar($d);
	ir('usuarios_lista.php');
}

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->assign('f',$f->flush(true));
$smarty->display('usuarios_modificar.html');
if ($config['debug']['debug']=='SI') {echo __FILE__;}
