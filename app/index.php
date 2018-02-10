<?php
include 'inicializacion.php';

$_SESSION = array();
$lang     = parse_ini_file('./configs/lang/index.inc',false);
$f        = new FormHandler('login',NULL,'role="form" class = "form-inline"');

$f->useTable( false );
$f->setMask($config['mascaras']['mlogin'],true);

$f->textField($lang['lgn'],'id',FH_STRING,0,0,"class='form-control'");
$f->passField($lang['clv'],'clave',FH_STRING,0,0,"class='form-control'");
$f->submitButton($lang['cnt'],'botonSubmit');

$f->setFocus('id');
$f->onCorrect('proc_login');

function proc_login($d){
	$res=bd_usuarios_verificar($d);

	if(count($res>0)){
		$_SESSION['usuario']=$res[0];
	} else {
		$_SESSION['usuario']=array();
	}


	$destino=array(
		'ADMINISTRADOR' => 'menu_admin.php',
		'SISTEMA'       => 'menu_sistema.php',
		'TRABAJADOR'    => 'menu_trabajador.php',
		''              => 'index.php?mensaje=Error en la entrada'
	);

	ir($destino[$_SESSION['usuario']['nivel']]);
}

$mensaje=isset($_REQUEST['mensaje'])?$_REQUEST['mensaje']:$lang['msj'];

$smarty->assign('mensaje',$mensaje);

$smarty->assign('cab','');
$smarty->assign('pie','');
$smarty->assign('f',$f->flush(true));
$smarty->display('index.html');

if ($config['debug']['debug']=='SI') {echo __FILE__;}
