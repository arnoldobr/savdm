<?php /* Smarty version 3.1.27, created on 2018-02-10 17:17:09
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/finalv.html" */ ?>
<?php
/*%%SmartyHeaderCode:19400865645a7f6155a78fb6_77131519%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ed8ac6572ca913a04d53f1ccf9977bafa443cee0' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/finalv.html',
      1 => 1516218413,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19400865645a7f6155a78fb6_77131519',
  'variables' => 
  array (
    'pie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f6155a7d240_32848750',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f6155a7d240_32848750')) {
function content_5a7f6155a7d240_32848750 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '19400865645a7f6155a78fb6_77131519';
?>
</div>

               </div>
        </div>
        </section>
<!-- core jquery  -->
<?php echo '<script'; ?>
 src="./libs/js/jquery/jquery-2.1.4.min.js"><?php echo '</script'; ?>
>
<!-- bootstrap scripts  -->
<?php echo '<script'; ?>
 src="./libs/bs_tpl/plugins/bootstrap.js"><?php echo '</script'; ?>
>
<!-- eModal.js -->
<?php echo '<script'; ?>
 src="./libs/bootstrap/emodal/dist/eModal.min.js"><?php echo '</script'; ?>
>
<!-- custom scripts  -->
<!-- script src="./libs/bs_tpl/js/custom.js"><?php echo '</script'; ?>
 -->
<?php echo $_smarty_tpl->tpl_vars['pie']->value;?>
<!-- eModal.js -->
<?php echo '<script'; ?>
 src="./libs/bootstrap/emodal/dist/eModal.js"><?php echo '</script'; ?>
>
</body>
</html><?php }
}
?>