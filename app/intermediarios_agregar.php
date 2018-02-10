<?php
include 'inicializacion.php';

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

$f_meta=proc_meta("intermediarios");

$f = new FormHandler('intermediarios',NULL,'role="form"');
$f -> useTable( false );
$f -> setMask($config['mascaras']['m1'],true);


$f -> borderStart('intermediarios');

$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 100 );


$f->setErrorMessage('nombre', $f_meta['nombre']['error']);

$f->setHelpText('nombre', $f_meta['nombre']['ayuda']);

#$f->setValue('nombre', '');
#$f->setValue('telefono', '');
#$f->setValue('direccion', '');
#$f->setValue('intermediario_id', '');

$f -> submitButton('Continuar','botonSubmit');
$f -> borderStop();
$f -> onCorrect('proc_intermediarios_agregar');

function proc_intermediarios_agregar($d)
{
    bd_intermediarios_agregar($d);
    ir('mensajev.php?mensaje=Elemento Agregado correctamente');
}

$smarty -> assign('cab','');
$smarty -> assign('pie','');
$smarty -> assign('f',$f -> flush(true));
$smarty -> display("intermediarios_agregar.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
