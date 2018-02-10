<?php
include('inicializacion.php');

if(!isset($_SESSION['usuario'])){
    ir('index.php');
}

if (PHP_OS=='Linux') {
	$dump   = 'mysqldump';
	$direct = APP . '/respaldobd/';
}else{ 
	// Windows
	// Ubique la ruta exacta de mysqldump.exe y modifique la siguiente línea
	// si el servidor está ubicado en una máquina con windows
	$dump   = 'c:\xampp\mysql\bin\mysqldump.exe';
	$direct = APP . '\\respaldobd\\';
}

$archivo= $direct. date("YmdHis").'.sql';

exec("$dump -u{$config['bd']['login']} -p{$config['bd']['clave']} {$config['bd']['bd']} >{$archivo} ");

ir('sqlguardar.php');
