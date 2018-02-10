<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
	# code...
	ir('index.php');
}



$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');;

$id=$_REQUEST['id'];
$datos=bd_cargos_datos($id);

#vq($datos);



$smarty->assign('d',$datos);
$smarty->assign('meta',proc_meta("cargos"));

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->display("cargos_ficha.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
