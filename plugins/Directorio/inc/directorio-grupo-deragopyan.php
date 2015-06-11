<?php require_once(DIRECTORIO_PLUGIN_DIR."class/class.grupo.deragopyan.php"); ?>
<?php function setGrupoDeagopyan(){ ?>

<?php 
	if(isset($_POST["directorio"])):
		D_Grupos::newOption($_POST);
	endif;
 ?>
<div class="directorio-deragopyan options">
		<h1>Directorio Deragopyan</h1>
		<h3>Grupos de trabajo</h3>

		<form action="" method="post" class="data-form" >
			<span style="display:none;">El nombre del puesto</span>
			<input type="text" name="directorio-value" placeholder="Nombre del nuevo grupo de trabajo" class="data-value">
			<input type="submit" value="Crear">
			<input type="hidden" name="directorio" value="1">
			<p><?php D_Grupos::success(); ?></p>
		</form>

		<br>
		<h3>Lista de puestos creados</h3>
		<ul id="optionList">
			<?php foreach(D_Grupos::getOptions(null,true) as $k => $v): ?>
			<li>
				<input type="text" disabled="" value="<?php echo($v->value_option) ?>" class="valueOption">
				<input type="hidden" name="optionID" value="<?php echo($v->id) ?>">
				<input type="hidden" name="postName" value="grupos">
				<span style="display:none;">puesto</span>
				<button class="save">Guardar</button>
				<button class="edit">Editar</button>
				<button class="delete">Eliminar</button>
			</li>
			<?php endforeach; ?>
		</ul>

		
</div>


<?php } ?>