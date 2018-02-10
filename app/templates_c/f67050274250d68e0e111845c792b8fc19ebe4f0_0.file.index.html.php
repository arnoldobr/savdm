<?php /* Smarty version 3.1.27, created on 2018-02-10 16:43:59
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/index.html" */ ?>
<?php
/*%%SmartyHeaderCode:9881568715a7f598f1571c8_65644267%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f67050274250d68e0e111845c792b8fc19ebe4f0' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/index.html',
      1 => 1516218413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9881568715a7f598f1571c8_65644267',
  'variables' => 
  array (
    'mensaje' => 0,
    'f' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f598f726080_57010152',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f598f726080_57010152')) {
function content_5a7f598f726080_57010152 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '9881568715a7f598f1571c8_65644267';
echo $_smarty_tpl->getSubTemplate ("inicio0.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<div class="centro">
	<div class="alert alert-danger" role="alert"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
	<img src="./imagenes/logo.png" alt="Sistema Universo Gráfico" />
</div>
<?php echo $_smarty_tpl->tpl_vars['f']->value;?>

<?php echo $_smarty_tpl->getSubTemplate ("final0.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>