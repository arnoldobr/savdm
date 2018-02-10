<?php
include 'inicializacion.php';

$autorizados=array('ADMINISTRADOR','OPERADOR');
if(!in_array($_SESSION['usuario']['nivel'],$autorizados))
{
    ir('menu.php?mensaje=Necesitas autorización para acceder al módulo...');
    exit;
}

$f_meta=proc_meta("clientes");

$f = new FormHandler('clientes',NULL,'role="form"');
$f -> useTable( false );
$f -> setMask($config['mascaras']['m1'],true);


$f -> borderStart('clientes');

$f->textField( $f_meta['nombre']['etiqueta'], 'nombre', FH_STRING, 50, 100 );
$f->textField( $f_meta['telefono']['etiqueta'], 'telefono', FH_STRING, 50, 500 );
$f->textArea( $f_meta['direccion']['etiqueta'], 'direccion', FH_TEXT, 65, 3, 'class="ckeditor" style="width: 712px;"');
$f->selectfield( $f_meta['intermediario_id']['etiqueta'], 'intermediario_id', bd_intermediarios_opciones() );

$f->setErrorMessage('nombre', $f_meta['nombre']['error']);
$f->setErrorMessage('telefono', $f_meta['telefono']['error']);
$f->setErrorMessage('direccion', $f_meta['direccion']['error']);
$f->setErrorMessage('intermediario_id', $f_meta['intermediario_id']['error']);

$f->setHelpText('nombre', $f_meta['nombre']['ayuda']);
$f->setHelpText('telefono', $f_meta['telefono']['ayuda']);
$f->setHelpText('direccion', $f_meta['direccion']['ayuda']);
$f->setHelpText('intermediario_id', $f_meta['intermediario_id']['ayuda']);

#$f->setValue('nombre', '');
#$f->setValue('telefono', '');
#$f->setValue('direccion', '');
#$f->setValue('intermediario_id', '');

$f -> submitButton('Continuar','botonSubmit');
$f -> borderStop();
$f -> onCorrect('proc_clientes_agregar');

function proc_clientes_agregar($d)
{
    bd_clientes_agregar($d);
    ir('mensajev.php?mensaje=Elemento Agregado correctamente');
}

$smarty -> assign('cab','');
$smarty -> assign('pie','');
$smarty -> assign('f',$f -> flush(true));
$smarty -> display("clientes_agregar.html");
if ($config['debug']['debug']=='SI') {echo __FILE__;}
