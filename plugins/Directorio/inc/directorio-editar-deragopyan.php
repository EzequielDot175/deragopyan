<?php 
	// require "../class.puestos.deragopyan.php";
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.puestos.deragopyan.php");
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.empleado.deragopyan.php");
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.gerencia.deragopyan.php");
	require_once(DIRECTORIO_PLUGIN_DIR."class/class.grupo.deragopyan.php");
 ?>
<?php function editEmployeerDeragopyan(){ ?>

<?php 
	if (isset($_GET["pid"])):
		$row = D_Empleado::getUser((int)$_GET["pid"]);
	endif;
	if(isset($_POST["editEmployeer"])):
		D_Empleado::update($_POST,$_FILES);
	endif;
	if(D_Empleado::success(true)):
		?><script>window.location.href = "?page=directorio-deragopyan";</script><?php
	endif;
 ?>
<div class="directorio-deragopyan">
	<h1>Crear empleado deragopyan</h1>
	<h3>Complete los campos</h3>

	<form action="" method="post" enctype="multipart/form-data">
		<fieldset>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" value="<?php echo($row->dir_nombre) ?>">
		</fieldset>
		<fieldset>
			<label for="apellido">Apellido</label>
			<input type="text" name="apellido" value="<?php echo($row->dir_apellido) ?>">
		</fieldset>
		<fieldset>
			<label for="sede">Elija sede por favor</label>
			<select name="sede" id="">
				<?php sedes_deragopyan_options_fetch($row->dir_sede); ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="puesto">Puesto</label>
			<select name="puesto" id="">
				<?php D_Puestos::getOptions($row->dir_puesto) ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="grupo">Grupo de trabajo</label>
			<select name="grupo" id="">
				<?php D_Grupos::getOptions($row->dir_grupo) ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="gerencia-area">Gerencia/Area</label>
			<select name="gerencia-area" id="">
				<?php D_Gerencia::getOptions($row->dir_gerencia_area) ?>
			</select>
		</fieldset>
		<fieldset>
			<label for="interno">Interno</label>
			<input type="text" name="interno" id="" value="<?php echo($row->dir_interno) ?>"> 
		</fieldset>
		<fieldset>
			<label for="celular">Celular</label>
			<input type="text" name="celular" id="" value="<?php echo($row->dir_celular) ?>"> 
		</fieldset>
		<fieldset>
			<label for="mail">Mail</label>
			<input type="text" name="mail" id="" value="<?php echo($row->dir_mail) ?>"> 
		</fieldset>
		<fieldset>
			<label for="foto">Foto</label>
			<div class="box">
				<img src="<?php echo(DIRECTORIO_LINK_IMAGES.$row->dir_foto) ?>" alt="" heigth="100" width="100" id="preview-image-directorio">
				<br>
				<button id="editImage">Editar</button>
			</div>
			<input type="file" name="foto" id="" value="<?php echo($row->dir_foto) ?>" class="hidden"> 
		</fieldset>
		<fieldset>
			<label for="fecha-nac">Fecha nacimiento</label>
			<input type="date" name="fecha-nac" id="" value="<?php echo($row->dir_fecha_nac) ?>"> 
		</fieldset>
		<fieldset>
			<label for="num-legajo">Numero de legajo</label>
			<input type="text" name="num-legajo" id="" value="<?php echo($row->dir_num_legajo) ?>"> 
		</fieldset>
		<input type="hidden" name="editEmployeer" value="1">
		<input type="hidden" name="employeer" value="<?php echo($row->id) ?>">
		<input type="submit" value="Editar empleado">
		<input type="hidden" name="currentImg" value="<?php echo($row->dir_foto) ?>">
	</form>
</div>
<script>
	jQuery(document).ready(function($) {
		$('#editImage').click(function(event) {
			event.preventDefault();
			$('input.hidden').trigger('click');
		});
		function readURL(input) {
		    if (input.files && input.files[0]) {
		        var reader = new FileReader();
		        reader.onload = function (e) {
		            $('#preview-image-directorio').attr('src', e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}

		$('input.hidden').change(function(event) {
			readURL(this);
		});
	});
</script>
<?php } ?>

