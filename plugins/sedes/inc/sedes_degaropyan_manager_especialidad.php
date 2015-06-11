<?php 

	function sedes_degaropyan_manager_especialidad(){
	global $wpdb;
	$rows = $wpdb->get_results("SELECT * FROM wp_sedes_especialidades");
?>
	
	<div class="jw_admin_wrap">
	    <h2>Agregar especialidad</h2>
	    <a href="admin.php?page=sedes_degaropyan_add_esp">
	    	<button class="button primary-button">Crear Especialidad</button>
	   	</a>

	   	<h3>Especialidades disponibles</h3>
	   	<ul>
	   		<?php foreach($rows as $k => $v): ?>
	   		<li>
	   			<img src="<?php echo(IMG_SEDES.$v->esp_icon) ?>" alt="" height="25" width="25">
	   			<a href="#"><?php echo($v->esp_name) ?></a>
	   			<a href="?page=sedes_degaropyan_edit_esp&id=<?php echo($v->id); ?>"><span class="dashicons dashicons-welcome-write-blog"></span></a>
	   			<a href="?page=sedes_degaropyan_rem_esp&id=<?php echo($v->id); ?>" class="delete"><span class="dashicons dashicons-dismiss"></span></a>
	   		</li>
	   		<?php endforeach; ?>
	   	</ul>
	</div>



<script>
	jQuery(document).ready(function($) {
		$('.delete').click(function(event) {
			var conf = confirm("Esta seguro que desea realizar esta accion");
			if (!conf) {
				event.preventDefault();
			};
		});
	});
</script>
<?php } ?>
