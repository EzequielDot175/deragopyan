<?php 
	// require "../class.puestos.deragopyan.php";
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.puestos.deragopyan.php");
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.empleado.deragopyan.php");
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.gerencia.deragopyan.php");
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.grupo.deragopyan.php");
 ?>
<?php function setEmpleadoDeagopyan(){ ?>
<?php 
	if(isset($_POST["addEmployer"])):
		D_Empleado::add($_POST,$_FILES);
	endif;

 ?>
<div class="directorio-deragopyan">
	<h1>Crear empleado deragopyan</h1>
	<h3>Complete los campos</h3>

	<form action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre">
		</fieldset>
		<fieldset>
			<label for="apellido">Apellido</label>
			<input type="text" name="apellido">
		</fieldset>
		<fieldset>
			<label for="sede">Elija sede por favor</label>
			<select name="sede" id="">
				<?php sedes_deragopyan_options_fetch(); ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="puesto">Puesto</label>
			<select name="puesto" id="">
				<?php D_Puestos::getOptions() ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="grupo">Grupo de trabajo</label>
			<select name="grupo" id="">
				<?php D_Grupos::getOptions() ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="gerencia-area">Gerencia/Area</label>
			<select name="gerencia-area" id="">
				<?php D_Gerencia::getOptions() ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="interno">Interno</label>
			<input type="text" name="interno" id=""> 
		</fieldset>
		<fieldset>
			<label for="celular">Celular</label>
			<input type="text" name="celular" id=""> 
		</fieldset>
		<fieldset>
			<label for="mail">Mail</label>
			<input type="text" name="mail" id=""> 
		</fieldset>
		<fieldset>
			<label for="foto">Foto</label>
			<input type="file" name="foto" id=""> 
		</fieldset>
		<fieldset>
			<label for="fecha-nac">Fecha nacimiento</label>
			<input type="date" name="fecha-nac" id=""> 
		</fieldset>
		<fieldset>
			<label for="num-legajo">Numero de legajo</label>
			<input type="text" name="num-legajo" id=""> 
		</fieldset>
		<input type="hidden" name="addEmployer" value="1">
		<input type="submit" value="Agregar empleados">
	</form>
	<p><?php D_Empleado::success() ?></p>
</div>
<?php } ?>