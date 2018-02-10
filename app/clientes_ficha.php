<?php
include 'inicializacion.php';

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('clientes_lista.php');
$id=$_REQUEST['id'];

$datos=bd_clientes_datos($id);
$datos['intermediario']= bd_intermediarios_dato($datos['intermediario_id'],'nombre')['nombre'];

$antsig=bd_clientes_antsig($id);

$miscampos=array("id","nombre","telefono","direccion","intermediario_id");
$cantcampos=count($miscampos);
$smarty->assign('c',$miscampos);
$smarty->assign('n',$cantcampos);
$smarty->assign('d',$datos);
$smarty->assign('antsig',$antsig);
$smarty->assign('meta',proc_meta("clientes"));

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->display("clientes_ficha.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
