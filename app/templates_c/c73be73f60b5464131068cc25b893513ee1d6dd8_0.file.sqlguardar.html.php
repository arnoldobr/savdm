<?php /* Smarty version 3.1.27, created on 2018-02-10 16:45:15
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/sqlguardar.html" */ ?>
<?php
/*%%SmartyHeaderCode:15471862195a7f59dbb50586_18562872%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c73be73f60b5464131068cc25b893513ee1d6dd8' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/sqlguardar.html',
      1 => 1516218413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15471862195a7f59dbb50586_18562872',
  'variables' => 
  array (
    'a' => 0,
    'b' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f59dbb9c695_70921927',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f59dbb9c695_70921927')) {
function content_5a7f59dbb9c695_70921927 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '15471862195a7f59dbb50586_18562872';
echo $_smarty_tpl->getSubTemplate ("inicio.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

<h1><img src="./imagenes/48/bd.png" alt="">Respaldo del Sistema&nbsp;<a class="btn btn-default btn-lg" href="sqlrespaldo.php"><i class="fa fa-plus"></i></a></h1>


    <table border="1" class="table table-condensed table-hover table-bordered display" id="tabla_respaldos" style="max-width:100%;">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Tamaño</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['i'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['i']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['name'] = 'i';
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['a']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['i']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['i']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['i']['total']);
?>
            <tr>
                <td><?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['d'];?>
/<?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['mes'];?>
/<?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['a'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['h'];?>
:<?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['m'];?>
:<?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['s'];?>
</td>
                <td><?php echo $_smarty_tpl->tpl_vars['b']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']];?>
 bytes</td>
                <td>
                	<div class="btn-group">
        				<a class="btn btn-default" title="Descargar"
            				href="./respaldobd/<?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['basename'];?>
" download><i 
            				class="fa fa-download"></i></a>
        				<a class="btn btn-default" title="Eliminar"
            				href="sqlelim.php?a=<?php echo $_smarty_tpl->tpl_vars['a']->value[$_smarty_tpl->getVariable('smarty')->value['section']['i']['index']]['basename'];?>
"><i 
            				class="fa fa-trash-o"></i></a>
    				</div>
    			</td>
            </tr>
            <?php endfor; endif; ?>
        </tbody>
    </table>

<?php echo $_smarty_tpl->getSubTemplate ("final.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);

}
}
?>