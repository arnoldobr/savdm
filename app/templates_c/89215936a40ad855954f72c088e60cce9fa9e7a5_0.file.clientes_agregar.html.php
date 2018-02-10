<?php /* Smarty version 3.1.27, created on 2018-02-10 17:41:39
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/clientes_agregar.html" */ ?>
<?php
/*%%SmartyHeaderCode:285416465a7f6713be2e92_91172718%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89215936a40ad855954f72c088e60cce9fa9e7a5' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/clientes_agregar.html',
      1 => 1514416205,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '285416465a7f6713be2e92_91172718',
  'variables' => 
  array (
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f6713c44b23_68430417',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f6713c44b23_68430417')) {
function content_5a7f6713c44b23_68430417 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '285416465a7f6713be2e92_91172718';
echo $_smarty_tpl->getSubTemplate ("iniciov.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php echo $_smarty_tpl->tpl_vars['f']->value;?>

<?php echo $_smarty_tpl->getSubTemplate ("finalv.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<?php echo '<script'; ?>
>
$(document).ready(function() {
     var max = 0;
     $(".etiqueta1").each(function(){
         if ($(this).width() > max)
             max = $(this).width();
     });


     $(".etiqueta1").width(max + 10);
     $(".fila_form:odd").addClass('form_impar');

     var max2 = 0;
     $(".campo1").each(function(){
         if ($(this).width() > max2)
             max2 = $(this).width();
     });

     $(".campo1").width(max2 + 10);

 });
<?php echo '</script'; ?>
>
<?php }
}
?>