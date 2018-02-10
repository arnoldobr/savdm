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

if (!isset($_REQUEST['id'])) ir('usuarios_lista.php');

$id = $_REQUEST['id'];
$datos = bd_usuarios_datos($id);

$f_meta = proc_meta('usuarios');

$f = new FormHandler('usuarios');
$f -> useTable( False );
$f -> setMask($config['mascaras']['m1'],true);

$f->borderStart("Usuario: {$datos['nombre']} ({$datos['id']})");

$f->hiddenField( 'id', $id);
$f->passField( $f_meta['clave']['etiqueta'], 'clave', FH_STRING, 41, 41 );
$f->passField( $f_meta['clave_ver']['etiqueta'], 'clave_ver', FH_STRING, 41, 41 );
$f->checkPassword( "clave", "clave_ver" );
$f->submitButton('Continuar','botonSubmit');
$f->borderStop();
$f->onCorrect('proc_usuarios_modificar_clave');

function proc_usuarios_modificar_clave($d)
{
    bd_usuarios_cambiar_clave($d);
    ir('mensaje.php?mensaje=Clave cambiada con éxito.');
}

$smarty->assign('cab','');
$smarty->assign('pie','');
$smarty->assign('f',$f->flush(true));
$smarty->display('usuarios_cambiar_clave.html');
if ($config['debug']['debug']=='SI') {echo __FILE__;}
