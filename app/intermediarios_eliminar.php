<?php
include 'inicializacion.php';

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('intermediarios_lista.php');

$id=$_REQUEST['id'];
$datos=bd_intermediarios_datos($id);
//$datos['intermediario']= bd_intermediarios_dato($datos['intermediario_id'],'nombre')['nombre'];

$smarty->assign('id',$id);
$smarty->assign('d',$datos);
$smarty->assign('meta',proc_meta("intermediarios"));


$smarty->assign('cab','');
$smarty->assign('pie','');
$smarty->display("intermediarios_eliminar.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
