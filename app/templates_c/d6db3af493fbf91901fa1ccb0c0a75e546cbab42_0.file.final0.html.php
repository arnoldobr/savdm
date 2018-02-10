<?php /* Smarty version 3.1.27, created on 2018-02-10 16:43:59
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/final0.html" */ ?>
<?php
/*%%SmartyHeaderCode:13108698885a7f598f80b012_63970264%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6db3af493fbf91901fa1ccb0c0a75e546cbab42' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/final0.html',
      1 => 1516488366,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13108698885a7f598f80b012_63970264',
  'variables' => 
  array (
    'pie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f598f83eb28_69601792',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f598f83eb28_69601792')) {
function content_5a7f598f83eb28_69601792 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '13108698885a7f598f80b012_63970264';
?>
</div>
            </div>
        </div>
    </section>
    <!--/.INTRO END-->
    <section id="footer-sec" class="hidden-print" >
        <div class="container">
            <div class="row  pad-bottom" >
                &copy;2018 José Manuel Matheus
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
</body>
</html><?php }
}
?>