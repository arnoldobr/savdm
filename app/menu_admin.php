<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
	# code...
	ir('index.php');
}


$lang=parse_ini_file('./configs/lang/menu.inc',false);

if(!isset($_SESSION['usuario']['nivel'])){
    ir("index.php?mensaje={$lang['no_acc']}");
}
$mensaje=isset($_REQUEST['mensaje'])?$_REQUEST['mensaje']:$lang['bienve'];
$smarty->assign('cab','');
$smarty->assign('pie','');
$smarty->assign('mensaje',$mensaje);
$smarty->display('menu_admin.html');
if ($config['debug']['debug']=='SI') {echo __FILE__;}
