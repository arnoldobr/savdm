<?php
include 'inicializacion.php';

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('productos_lista.php');
$id=$_REQUEST['id'];

$datos=bd_productos_datos($id);
//$datos['productos']= bd_productos_dato($datos['productos_id'],'nombre')['nombre'];

$antsig=bd_productos_antsig($id);

$miscampos=array("id","nombre","unidadcompra");
$cantcampos=count($miscampos);
$smarty->assign('c',$miscampos);
$smarty->assign('n',$cantcampos);
$smarty->assign('d',$datos);
$smarty->assign('antsig',$antsig);
$smarty->assign('meta',proc_meta("productos"));

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->display("productos_ficha.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
