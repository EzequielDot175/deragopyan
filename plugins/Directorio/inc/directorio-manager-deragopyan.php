<?php require_once(DIRECTORIO_PLUGIN_DIR."class/class.empleado.deragopyan.php"); ?>
<?php function getDirectorioHome(){ ?>

	<div class="directorio-deragopyan">
		<h1>Directorio Deragopyan</h1>
		<h3>Lista de empleados</h3>
		<a href="?page=crear-empleado-deragopyan" class="newEmployer">Agrega nuevo empleado</a>
		<div class="table menu">
			<div class="row">
				<div class="cell photo">
					Foto
				</div>
				<div class="cell name">
					Nombre completo
				</div>
				<div class="cell workposition">
					Puesto
				</div>
				<div class="cell mail">
					Mail
				</div>
				<div class="cell actions">

				</div>
			</div>
		</div>

		<div class="table results">
			<!-- foreach -->
			<?php D_Empleado::getDirectorioAdmin() ?>
			<!-- foreach -->
		</div>
	</div>
	<script>
		jQuery(document).ready(function($) {
			$('a.delete').click(function(event) {
				if (!confirm("¿Esta seguro que desea eliminar este perfil?")) {
					event.preventDefault();
				};
			});
		});
	</script>


  <?php } ?> 
