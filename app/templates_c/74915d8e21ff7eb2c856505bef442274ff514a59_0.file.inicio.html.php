<?php /* Smarty version 3.1.27, created on 2018-02-10 16:44:16
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/inicio.html" */ ?>
<?php
/*%%SmartyHeaderCode:19559624345a7f59a049d859_67066960%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74915d8e21ff7eb2c856505bef442274ff514a59' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/inicio.html',
      1 => 1516564265,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19559624345a7f59a049d859_67066960',
  'variables' => 
  array (
    'cab' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f59a04a2807_69133533',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f59a04a2807_69133533')) {
function content_5a7f59a04a2807_69133533 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '19559624345a7f59a049d859_67066960';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="description" content="universografico" />
<meta name="author" content="Arnoldo Bric (arnoldobr@gmail.com)" />
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
<style type="text/css" media="screen">
 html {
  overflow-y: scroll;
}
</style>
<?php echo $_smarty_tpl->tpl_vars['cab']->value;?>
</head>
<body >
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
   <!--/.NAVBAR END-->
    <section id="home" class="text-center"></section>
    <section id="intro">
        <div class="container">
        <div class="row" >
            <div class="col-md-12"><?php }
}
?>