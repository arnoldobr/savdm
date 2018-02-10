<?php
session_name('nomina');
session_start();
$config=parse_ini_file('./configs/config.inc',true);
include('./configs/bd.php');
include('./configs/funciones_sistema.php');
include('./configs/funciones.php');
include('./configs/smarty.php');
include('./modelo/bd_modelo.php');


$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('usuarios_lista.php');
$id=$_REQUEST['id'];
$datos=bd_usuarios_datos($id);
$antsig=bd_usuarios_antsig($id);

$miscampos=array("id","clave","nombre","nivel","email","activo");
$cantcampos=count($miscampos);
$smarty->assign('c',$miscampos);
$smarty->assign('n',$cantcampos);
$smarty->assign('d',$datos);
$smarty->assign('antsig',$antsig);
$smarty->assign('meta',proc_meta("usuarios"));

$smarty->assign('cab','');
$smarty->assign('pie','');

$smarty->display("usuarios_ficha.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
