<?php /* Smarty version 3.1.27, created on 2018-02-10 18:22:27
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/proveedores_agregar.html" */ ?>
<?php
/*%%SmartyHeaderCode:5994180515a7f70a34de140_88768830%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8be80d58cf9e398235be8b015ac2fb492ceb2b1b' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/proveedores_agregar.html',
      1 => 1518301338,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5994180515a7f70a34de140_88768830',
  'variables' => 
  array (
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f70a34e8e28_58439081',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f70a34e8e28_58439081')) {
function content_5a7f70a34e8e28_58439081 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5994180515a7f70a34de140_88768830';
echo $_smarty_tpl->getSubTemplate ("iniciov.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<?php echo $_smarty_tpl->tpl_vars['f']->value;?>

<?php echo $_smarty_tpl->getSubTemplate ("finalv.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<?php echo '<script'; ?>
>
$(document).ready(function() {
	var max = 0;
	$(".control-label").each(function(){
	if ($(this).width() > max)
		max = $(this).width();
	});


	$(".control-label").width(max + 10);

//	$(".fila_form:odd").addClass('form_impar');

	var max2 = 0;
	$(".campo1").each(function(){
	if ($(this).width() > max2)
		max2 = $(this).width();
	});

	$("[for='productos']").css('display','block');

	$(".campo1").width(max2 + 10);

});
<?php echo '</script'; ?>
>
<?php }
}
?>