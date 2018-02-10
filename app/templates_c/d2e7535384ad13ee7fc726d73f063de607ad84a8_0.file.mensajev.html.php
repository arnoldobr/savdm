<?php /* Smarty version 3.1.27, created on 2018-02-10 18:01:06
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/mensajev.html" */ ?>
<?php
/*%%SmartyHeaderCode:2378596535a7f6ba2d16ac3_04761419%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2e7535384ad13ee7fc726d73f063de607ad84a8' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/mensajev.html',
      1 => 1516218413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2378596535a7f6ba2d16ac3_04761419',
  'variables' => 
  array (
    'mensaje' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f6ba2d2a237_10739532',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f6ba2d2a237_10739532')) {
function content_5a7f6ba2d2a237_10739532 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2378596535a7f6ba2d16ac3_04761419';
echo $_smarty_tpl->getSubTemplate ("iniciov.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<div id="mensaje">
<div class="alert alert-info" role="alert"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
<button type="button" class="btn btn-primary" onClick="parent.location.reload(true);">Finalizar</button>
</div>
<?php echo $_smarty_tpl->getSubTemplate ("finalv.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>