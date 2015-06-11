<?php require_once(DIRECTORIO_PLUGIN_DIR."class/class.puestos.deragopyan.php"); ?>
<?php function setPuestoDeagopyan(){ ?>
<?php 
	if(isset($_POST["directorio"])):
		D_Puestos::newOption($_POST);
	endif;
 ?>
<div class="directorio-deragopyan options">
		<h1>Directorio Deragopyan</h1>
		<h3>Puestos de empleados</h3>
		

		<form action="" method="post" class="data-form" >
			<span style="display:none;">El nombre del puesto</span>
			<input type="text" name="directorio-value" placeholder="Nombre del nuevo puesto" class="data-value">
			<input type="submit" value="Crear">
			<input type="hidden" name="directorio" value="1">
			<p><?php D_Puestos::success(); ?></p>
		</form>
		<br>
		<h3>Lista de puestos creados</h3>
		<ul id="optionList">
			<?php foreach(D_Puestos::getOptions(null,true) as $k => $v): ?>
			<li>
				<input type="text" disabled="" value="<?php echo($v->value_option) ?>" class="valueOption">
				<input type="hidden" name="optionID" value="<?php echo($v->id) ?>">
				<input type="hidden" name="postName" value="puestos">
				<span style="display:none;">puesto</span>
				<button class="save">Guardar</button>
				<button class="edit">Editar</button>
				<button class="delete">Eliminar</button>
			</li>
			<?php endforeach; ?>
		</ul>

</div>


<?php } ?>