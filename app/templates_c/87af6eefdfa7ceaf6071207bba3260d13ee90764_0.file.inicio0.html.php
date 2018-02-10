<?php /* Smarty version 3.1.27, created on 2018-02-10 16:43:59
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/inicio0.html" */ ?>
<?php
/*%%SmartyHeaderCode:5665935955a7f598f774249_34042763%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87af6eefdfa7ceaf6071207bba3260d13ee90764' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/inicio0.html',
      1 => 1517274515,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5665935955a7f598f774249_34042763',
  'variables' => 
  array (
    'cab' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f598f7d6df4_72217632',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f598f7d6df4_72217632')) {
function content_5a7f598f7d6df4_72217632 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '5665935955a7f598f774249_34042763';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="universografico" />
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<![endif]-->
<title>SAVDM</title>

<link rel="apple-touch-icon" sizes="180x180" href="./apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="./favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="./favicon-16x16.png">
<link rel="manifest" href="./manifest.json">
<link rel="mask-icon" href="./safari-pinned-tab.svg" color="#5bbad5">
<meta name="theme-color" content="#ffffff">

<!-- bootstrap core style css -->
<link href="./libs/bs_tpl/css/bootstrap.css" rel="stylesheet" />
<!-- fontawesome style css -->
<link href="./libs/bs_tpl/css/font-awesome.min.css" rel="stylesheet" />
<!-- custom style css -->
<link href="./libs/bs_tpl/css/style.css" rel="stylesheet" />
<link href="./estilos/layout.css" rel="stylesheet" />
<link href="./estilos/sitio.css" rel="stylesheet" />
<?php echo $_smarty_tpl->tpl_vars['cab']->value;?>

</head>
<body>
    <div class="navbar navbar-inverse navbar-fixed-top" >
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="padding:0;"><img  class="img-responsive"
                    src="./imagenes/logo129x50.png" /></a>
            </div>
            <div class="navbar-collapse collapse">
                <?php echo $_smarty_tpl->getSubTemplate ("../menu/menu.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            </div>
        </div>
    </div>
    <section id="home" class="text-center"></section>
    <section id="intro">
        <div class="container">
            <div class="row text-center" >
                <div class="col-md-12"><?php }
}
?>