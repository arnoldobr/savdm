<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
	# code...
	ir('index.php');
}


$id = $_SESSION['usuario']['id'];
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
    ir('menu_trabajador.php?mensaje=Clave cambiada con éxito.');
}

$smarty->assign('cab','');
$smarty->assign('pie','');
$smarty->assign('f',$f->flush(true));
$smarty->display('usuarios_cambiar_clavep.html');
if ($config['debug']['debug']=='SI') {echo __FILE__;}
