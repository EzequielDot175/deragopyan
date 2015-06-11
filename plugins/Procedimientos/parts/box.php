
<select name="meta_tipo_proceso" id="meta_tipo_proceso">
	<option value="">Seleccione un tipo de procedimiento</option>
	<option value="Procedimiento">Procedimiento</option>
	<option value="Manual">Manual</option>
	<option value="Formulario">Formulario</option>
</select>
<input type="hidden" value="<?php echo(get_post_meta( $post->ID, 'meta_tipo_proceso', true )) ?>" id="meta_type">

<script>
	jQuery(document).ready(function($) {
		var type = $('#meta_type').val();
		$('#meta_tipo_proceso option').each(function(index, el) {
			if (type == el.value) {
				el.setAttribute("selected", "");
			};
		});
	});
</script>