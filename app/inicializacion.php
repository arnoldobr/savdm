<?php
session_name('nomina');
session_start();

define('APP',__DIR__);

$config=parse_ini_file(APP . '/configs/config.inc',true);

include(APP . '/configs/bd.php');
include(APP . '/configs/funciones_sistema.php');
include(APP . '/configs/fh3.php');
include(APP . '/configs/funciones.php');
include(APP . '/configs/smarty.php');
include(APP . '/configs/validacion.php');
include(APP . '/modelo/bd_modelo.php');
