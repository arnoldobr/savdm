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
$datos=bd_cargos_eliminar($id);
ir('mensajev.php?mensaje=cargo Eliminado de la Base de Datos correctamente');