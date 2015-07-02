<?php require_once(DIRECTORIO_PLUGIN_DIR."class/class.empleado.deragopyan.php"); ?>
<?php function getDirectorioHome(){ ?>

	<div class="directorio-deragopyan">
		<h1>Directorio Deragopyan</h1>
		<h3>Lista de empleados</h3>
		<a href="?page=crear-empleado-deragopyan" class="newEmployer">Agrega nuevo empleado</a>
		<a href="?page=crear-empleado-deragopyan" class="newEmployer">Cargar Excel</a>
		<div class="modalExcel">
			<form action="" id="excel" enctype="multipart/form-data">
				<input type="file" name="excel" accept=".xlsx">
				<br>
				<label for="checkbox">Tomar en cuenta los espacios en blanco</label>
				<input type="checkbox" name="emptySpaces">
				<br>
				<button>Subir</button>
				<p><em>El excel debera estar en el siguiente formato para hacer los cambios</em></p>
				<ul>
					<li>Nombre</li>
					<li>Apellido</li>
					<li>Sede</li>
					<li>Puesto</li>
					<li>Grupo de trabajo</li>
					<li>Gerencia/area</li>
					<li>Interno</li>
					<li>Celular</li>
					<li>Mail</li>
					<li>Fecha de nacimiento</li>
					<li>Numero de legajo</li>
				</ul>
				<p><em>En el caso de que la celda este vacia no se modificara el campo, si usted desea que el valor este vacio debe ingresar en la celda "ninguno" o bien seleccionar la opcion "Tomar en cuenta espacios vacios"</em></p>
			</form>
		</div>
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
			$('#excel').on('submit',function(event) {
				event.preventDefault();
				var formData = new FormData();
					formData.append('action','exceldirectorio');
					formData.append('file',$(this).children('input[type=file]')[0].files[0]);
			    $.ajax({
			    	url: ajaxurl,
			    	type: 'POST',
			    	contentType: false,
			        processData: false,
			    	data: formData,
			    	success: function(data){
			    		console.log(data);
			    	}
			    });
			    

			});
		});
	</script>



  <?php } ?> 
