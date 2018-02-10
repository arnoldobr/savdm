<?php /* Smarty version 3.1.27, created on 2018-02-10 16:44:16
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/final.html" */ ?>
<?php
/*%%SmartyHeaderCode:7534832845a7f59a04a9ca7_55642378%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc984fab247f6048f8bb7f0509ade25454bae77c' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/final.html',
      1 => 1516488350,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7534832845a7f59a04a9ca7_55642378',
  'variables' => 
  array (
    'pie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f59a04aca21_21125697',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f59a04aca21_21125697')) {
function content_5a7f59a04aca21_21125697 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '7534832845a7f59a04a9ca7_55642378';
?>
</div>
        </div>
    </div>
        </section>

<br>
    <!--/.INTRO END-->
    <section id="footer-sec" >

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
<?php echo $_smarty_tpl->tpl_vars['pie']->value;?>

</body>
</html><?php }
}
?>