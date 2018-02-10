<?php /* Smarty version 3.1.27, created on 2018-02-10 16:43:59
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/menu/menu.html" */ ?>
<?php
/*%%SmartyHeaderCode:8525299075a7f598f7dce87_27749680%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aae879b1c732776a349b8cccde92c16e3130a838' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/menu/menu.html',
      1 => 1516564137,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8525299075a7f598f7dce87_27749680',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f598f807478_35522085',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f598f807478_35522085')) {
function content_5a7f598f807478_35522085 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8525299075a7f598f7dce87_27749680';
?>
<ul class='nav navbar-nav navbar-right'>
<?php if (isset($_SESSION['usuario'])) {?>
	<?php if ($_SESSION['usuario']['nivel'] == "ADMINISTRADOR") {?>
		<li><a href="menu_admin.php">Inicio</a></li>
		<li class="dropdown"><a class="dropdown-toggle"
			data-toggle="dropdown" href="#">BD<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="clientes_lista.php">clientes</a></li>
				<li><a href="intermediarios_lista.php">intermediarios</a></li>
				<li><a href="productos_lista.php">productos</a></li>
				<li><a href="proveedores_lista.php">Proveedores</a></li>
				<li><a href="usuarios_lista.php">Usuarios</a></li>
			</ul>
		</li>
		<li><a href="sqlguardar.php">Respaldo</a></li>
	<?php } elseif ($_SESSION['usuario']['nivel'] == "OPERADOR") {?>
		<li><a href="menu_operador.php">Inicio</a></li>
		<li class="dropdown"><a class="dropdown-toggle"
			data-toggle="dropdown" href="#">Tablas<span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="clientes_lista.php">clientes</a></li>
				<li><a href="intermediarios_lista.php">intermediarios</a></li>
				<li><a href="productos_lista.php">productos</a></li>
				<li><a href="proveedores_lista.php">Proveedores</a></li>
			</ul>
		</li>
		<li><a href="sqlguardar.php">Respaldo</a></li>
	<?php } else { ?>
		<!-- none -->
	<?php }?>
	<li><a href='index.php'>Salir</a></li>
<?php }?>
</ul>
<?php }
}
?>