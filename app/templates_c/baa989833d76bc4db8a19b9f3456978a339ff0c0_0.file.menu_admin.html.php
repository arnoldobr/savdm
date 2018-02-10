<?php /* Smarty version 3.1.27, created on 2018-02-10 16:44:16
         compiled from "/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/menu_admin.html" */ ?>
<?php
/*%%SmartyHeaderCode:7157676295a7f59a045bbd1_21970792%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'baa989833d76bc4db8a19b9f3456978a339ff0c0' => 
    array (
      0 => '/home/arnoldobr/public_html/Estudiantes/JoseManuel/savdm/app/templates/menu_admin.html',
      1 => 1516491260,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7157676295a7f59a045bbd1_21970792',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5a7f59a049a574_26894781',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5a7f59a049a574_26894781')) {
function content_5a7f59a049a574_26894781 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '7157676295a7f59a045bbd1_21970792';
echo $_smarty_tpl->getSubTemplate ("inicio.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<div class="menu_adm">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4 col-md-3">
				<div class="thumbnail">
					<a href="nomina.php">
					<img src="./imagenes/nomina.png" alt="Nómina">
					<div class="caption">
					<h3>Crear Viaje</h3>
					</div>
					</a>
				</div>
			</div>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail">
			<a href="sqlguardar.php">
			<img src="./imagenes/basededatos.png" alt="Base de Datos">
			<div class="caption">
			<h3></h3>
			</div>
			</a>
			</div>
			</div>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail">
			<a href="empleados_lista.php">
			<img src="./imagenes/empleado01.png" alt="Empleados">
			<div class="caption">
			<h3>Empleados</h3>
			<!-- p>Módulo para registrar los trabajadores de la empresa. Accede a la lista de empleados ya registrados.</p -->
			</div>
			</a>
			</div>
			</div>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail">
			<a href="usuarios_lista.php">
			<img src="./imagenes/usuarios2.png" alt="Usuarios">
			<div class="caption">
			<h3>Usuarios</h3>
			<!-- p>Registra personas autorizadas para ingresar al sistema. Accede a la lista de usuarios ya registrados.</p -->
			</div>
			</a>
			</div>
			</div>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail">
			<a href="departamentos_lista.php">
			<img src="./imagenes/departamentos.png" alt="Departamentos">
			<div class="caption">
			<h3>Departamentos</h3>
			<!-- p>Registra los lugares de trabajo dentro de la empresa.Accede a la lista de departamentos ya registrados, donde se puede agregar, modificar y eliminar.</p -->
			</div>
			</div>
			</div>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail">
			<a href="cargos_lista.php">
			<img src="./imagenes/cargos1.png" alt="Cargos">
			<div class="caption">
			<h3>Cargos</h3>
			<!-- p>Registra los cargos de trabajo dentro de la empresa. Accede a la lista de cargos ya registrados, donde se puede agregar, modificar y eliminar.</p -->
			</div>
			</div>
			</div>
			<div class="col-sm-4 col-md-3">
			<div class="thumbnail">
			<a href="reportes_lista.php">
			<img src="./imagenes/reporte.png" alt="Reportes">
			<div class="caption">
			<h3>Reporte</h3>
			<!-- p>Informes que organizan y exhiben la información contenida en la base de datos. Muestra los datos por medio de un diseño atractivo.</p -->
			</div>
			</div>
			</div>
		</div>
	</div>
</div>

<?php echo $_smarty_tpl->getSubTemplate ("final.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>


<?php }
}
?>