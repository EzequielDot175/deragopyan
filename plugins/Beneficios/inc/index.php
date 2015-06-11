<div class="plugin-container beneficios">
	<h1>Beneficios</h1>
	<h3>Listado de beneficios</h3>
	<div class="lista-beneficios">
		<?php foreach(	$this->getList() as $k => $v ):  ?>
		<div>
			<img src="<?php $this->imgLink($v->logo) ?>" alt="" height="80" width="80">
			<span><?php echo($v->nombre) ?></span>
			<a href="?page=beneficios-deragopyan-edit&id=<?php echo($v->id) ?>">editar</a>
			<a href="#<?php echo($v->id) ?>" class="delete">eliminar</a>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="controls">
		<a href="?page=beneficios-deragopyan-create">Crear beneficio</a>
	</div>
</div>
<script>
	jQuery(document).ready(function($) {
		$(document).on('click', '.delete', function(event) {
			event.preventDefault();
			/* Act on the event */
			var id = parseInt($(this)[0].hash.replace(/#/, ''));
			var a = confirm("¿Esta seguro de realizar esta accion?");
			if (a) {
				$.post(ajaxurl,{action:"deletebeneficio",beneficio_id: id}, function(data) {
					if(parseInt(data.trim()) > 0){
						window.location.reload();
					}
				});
			};
		});
	});		
</script>
