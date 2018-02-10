<?php
include 'inicializacion.php';

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

$f_meta=proc_meta("productos");

$f = new FormHandler('productos',NULL,'role="form"');
$f -> useTable( false );
$f -> setMask($config['mascaras']['m1'],true);


$f -> borderStart('productos');

$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 100 );
$f->textField( $f_meta['unidadcompra']['etiqueta'], 'unidadcompra', FH_STRING, 50, 500 );

$f->setErrorMessage('nombre', $f_meta['nombre']['error']);
$f->setErrorMessage('unidadcompra', $f_meta['unidadcompra']['error']);

$f->setHelpText('nombre', $f_meta['nombre']['ayuda']);
$f->setHelpText('unidadcompra', $f_meta['unidadcompra']['ayuda']);

#$f->setValue('nombre', '');
#$f->setValue('telefono', '');
#$f->setValue('direccion', '');
#$f->setValue('intermediario_id', '');

$f -> submitButton('Continuar','botonSubmit');
$f -> borderStop();
$f -> onCorrect('proc_productos_agregar');

function proc_productos_agregar($d)
{
    bd_productos_agregar($d);
    ir('mensajev.php?mensaje=Elemento Agregado correctamente');
}

$smarty -> assign('cab','');
$smarty -> assign('pie','');
$smarty -> assign('f',$f -> flush(true));
$smarty -> display("productos_agregar.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
