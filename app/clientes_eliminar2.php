<?php
include 'inicializacion.php';

if(!in_array(
	$_SESSION['usuario']['nivel'],
	['ADMINISTRADOR','OPERADOR']
)){
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

if (!isset($_REQUEST['id'])) ir('clientes_lista.php');

$id=$_REQUEST['id'];
$datos=bd_clientes_eliminar($id);
ir('mensajev.php?mensaje=Elemento eliminado satisfactoriamente');