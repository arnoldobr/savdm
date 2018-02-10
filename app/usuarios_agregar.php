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

$f_meta=proc_meta("usuarios");

$f = new FormHandler('usuarios',NULL,'role="form"');
$f -> useTable( false );
$f -> setMask($config['mascaras']['m1'],true);


$f -> borderStart('Usuarios');

$f->textField( $f_meta['id']['etiqueta'], 'id', FH_STRING, 32, 32 );
$misal = cadenaaleatoria(20);
$f->hiddenField("sal","$misal");
$f->passField($f_meta['clave']['etiqueta'], 'clave', FH_STRING, 50, 255 );
$f->passField($f_meta['clave']['etiqueta'], 'clave_ver', FH_STRING, 50, 255 );
$f->checkPassword( "clave", "clave_ver" );
$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 255 );
$f->selectField( $f_meta['nivel']['etiqueta'], 'nivel', array('ADMINISTRADOR','OPERADOR','TRABAJADOR'), FH_STRING, false );
$f->textField( $f_meta['email']['etiqueta'], 'email', FH_STRING, 50, 255 );
$f->selectField( $f_meta['activo']['etiqueta'], 'activo', array('NO','SI','',''), FH_STRING, false );

$f->setErrorMessage('id', $f_meta['id']['error']);
$f->setErrorMessage('clave', $f_meta['clave']['error']);
$f->setErrorMessage('nombre', $f_meta['nombre']['error']);
$f->setErrorMessage('nivel', $f_meta['nivel']['error']);
$f->setErrorMessage('email', $f_meta['email']['error']);
$f->setErrorMessage('activo', $f_meta['activo']['error']);

$f->setHelpText('id', $f_meta['id']['ayuda']);
$f->setHelpText('clave', $f_meta['clave']['ayuda']);
$f->setHelpText('nombre', $f_meta['nombre']['ayuda']);
$f->setHelpText('nivel', $f_meta['nivel']['ayuda']);
$f->setHelpText('email', $f_meta['email']['ayuda']);
$f->setHelpText('activo', $f_meta['activo']['ayuda']);

#$f->setValue('id', '');
#$f->setValue('clave', '');
#$f->setValue('nombre', '');
#$f->setValue('nivel', '');
#$f->setValue('email', '');
#$f->setValue('activo', '');

$f -> submitButton('Continuar','botonSubmit');
$f -> borderStop();
$f -> onCorrect('proc_usuarios_agregar');

function proc_usuarios_agregar($d)
{
	$d['clave']=cifra_clave($d['clave']);
    bd_usuarios_agregar($d);
    ir('mensajev.php?mensaje=Elemento Agregado correctamente');
}

$smarty -> assign('cab','');
$smarty -> assign('pie','');
$smarty -> assign('f',$f -> flush(true));
$smarty -> display("usuarios_agregar.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
