<div class="organi-panel-admin">
	<h1>Organigramas</h1>
	<h3>Lista</h3>
	<div class="panel">
		<div class="row menu">
			<div class="cell id">ID</div>
			<div class="cell name">NOMBRE</div>
			<div class="cell options">Opciones</div>
		</div>
		<?php foreach(OrgranigramaDeragopyan::getOrganiList() as $k => $v): ?>
		<div class="row">
			<div class="cell bb id"><?php echo($v->id) ?></div>
			<div class="cell bb name"><?php echo($v->name) ?></div>
			<div class="cell bb options">
				<a href="?page=organigrama-deragopyan-edit&id=<?php echo($v->id) ?>">Editar</a>
				<a href="#<?php echo($v->id) ?>" class="delete">Borrar</a>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
	<h3>Crear organigrama</h3>
	<a href="?page=organigrama-deragopyan-create" class="btn-link">Crear nuevo organigrama</a>
</div>

<script>
	jQuery(document).ready(function($) {
		$('.delete').click(function(event) {
			event.preventDefault();
			id = parseInt($(this).parents(".row").children('.id').text());
			if (confirm("¿Esta seguro de realizar esta accion?")) {
				var params = {action: "ajaxfilterpersonal", unsetOrgani: id};
				$.post(ajaxurl,params, function(data) {
					console.log(data);
					if (data.trim() == 1) {
						$(this).parents(".row").remove();
					};
				});
			};
		});
	});
</script>