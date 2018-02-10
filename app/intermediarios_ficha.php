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

$datos = bd_intermediarios_datos($id);

$antsig=bd_intermediarios_antsig($id);

$miscampos=array("id","nombre");
$cantcampos=count($miscampos);
$smarty->assign('c',$miscampos);
$smarty->assign('n',$cantcampos);
$smarty->assign('d',$datos);
$smarty->assign('antsig',$antsig);
$smarty->assign('meta',proc_meta("intermediarios"));

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->display("intermediarios_ficha.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
