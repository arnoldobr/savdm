<?php
include 'inicializacion.php';

if (!isset($_SESSION['usuario'])) {
    ir('index.php');
}


$archivo=$_REQUEST['a'];

unlink("./respaldobd/{$archivo}");
ir('sqlguardar.php');