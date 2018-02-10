<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
	# code...
	ir('index.php');
}


$autorizados = array('ADMINISTRADOR', 'OPERADOR');
if (!in_array($_SESSION['usuario']['nivel'], $autorizados)) {
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('cargos_lista.php');

$id=$_REQUEST['id'];
$datos=bd_cargos_datos($id);

$smarty->assign('id',$id);
#$smarty->assign('c',$miscampos);
#$smarty->assign('n',$cantcampos);
$smarty->assign('d',$datos);

$smarty->assign('cab','');
$smarty->assign('pie','');
$smarty->display("cargos_eliminar.html");