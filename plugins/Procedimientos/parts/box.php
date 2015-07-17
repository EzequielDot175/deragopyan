
<select name="meta_tipo_proceso" id="meta_tipo_proceso">
	<option value="">Seleccione un tipo de procedimiento</option>
	<option value="perfiles">Perfiles</option>
	<option value="pg">PG</option>
	<option value="formulario">Formulario</option>
</select>
<input type="hidden" value="<?php echo(get_post_meta( $post->ID, 'meta_tipo_proceso', true )) ?>" id="meta_type">


<?php 
	echo "<pre>";
	print_r();
	echo "</pre>";
	$meta_data = get_post_meta( $post->ID, 'meta_proceso_perfiles', true );
	if(!empty($meta_data)):
		$meta_data = json_decode($meta_data);
		echo "<pre>";
		print_r($meta_data);
		echo "</pre>";
	endif;
 ?>


<div id="loadForms">
	<div class="form-perfiles">
		<h3>Puesto</h3>
		<h1><input type="text" name="meta_proceso_perfiles[puesto]" value="<?php echo($meta_data->puesto); ?>"></h1>
		<h3>FUNCIÓN PRINCIPAL</h3>



		<?php wp_editor( $meta_data->funcion_principal, "meta_funcion" ,
			array( 'media_buttons' => false ,
					'textarea_name'=> 'meta_proceso_perfiles[funcion_principal]',
					'textarea_rows' => 5)); ?>




		<h3>RELACIONES</h3>
		<h4>Internas:</h4>


		Reporta a: <input type="text" name="meta_proceso_perfiles[relaciones][internas]" value="<?php echo($meta_data->relaciones->internas) ?>"> Supervisa a : <input type="text"  name="meta_proceso_perfiles[relaciones][internas][supervisa]" value="<?php echo($meta_data->relaciones->internas->supervisa) ?>">
		<h4>Externas:</h4>
		Contacto con: <input type="text" name="meta_proceso_perfiles[relaciones][externas]" value="<?php echo($meta_data->relaciones->externas) ?>">
	
		<h3>Descripcion del puesto</h3>


		<?php wp_editor( $content, "meta_puesto" ,
		array( 'media_buttons' => false,
				'textarea_name'=> 'meta_proceso_perfiles[descripcion_puesto]',
				'textarea_rows' => 5 )); ?>

		<h3>EDUCACION/FORMACION REQUERIDA</h3>

		<?php wp_editor( $content, "meta_formacion" ,array( 'media_buttons' => false,
									'textarea_name'=> 'meta_proceso_perfiles[formacion]',
									'textarea_rows' => 5)); ?>

		<h3>EXPERIENCIA REQUERIDA</h3>
		<?php wp_editor( $content, "meta_experiencia" ,array( 'media_buttons' => false ,
																'textarea_name'=> 'meta_proceso_perfiles[experiencia]',
																	'textarea_rows' => 5)); ?>
		
		<h3>PLAN DE CAPACITACIÓN OBLIGATORIO PARA EL PUESTO</h3>
		<h4>Capacitación General</h4>
		<?php wp_editor( $content, "meta_general_general" ,array( 'media_buttons' => false ,
															'textarea_name'=> 'meta_proceso_perfiles[capacitacion][general]',
																'textarea_rows' => 5)); ?>
		<h4>Capacitación específica </h4>
		<?php wp_editor( $content, "meta_general_especifica" ,array( 'media_buttons' => false ,
															'textarea_name'=> 'meta_proceso_perfiles[capacitacion][especifica]',
																'textarea_rows' => 5)); ?>

		<input type="text" value="Capacitación en los servicios y beneficios que brinda CMD">
		<h3>PERFIL DE USUARIO DE SISTEMAS</h3>
		<?php wp_editor( $content, "meta_perfil_usuario_sistemas" ,array( 'media_buttons' => false ,
																'textarea_name'=> 'meta_proceso_perfiles[perfil][usuario]',
																	'textarea_rows' => 5)); ?>
		<h3>COMPETENCIA</h3>
		<h4>Competencias Generales</h4>
		<?php wp_editor( $content, "meta_competencia_general" ,array( 'media_buttons' => false ,
																'textarea_name'=> 'meta_proceso_perfiles[competencia][general]',
																	'textarea_rows' => 5)); ?>
		
		<h4>Competencias Específicas</h4>
		<?php wp_editor( $content, "meta_competencia_especifica" ,array( 'media_buttons' => false ,
																'textarea_name'=> 'meta_proceso_perfiles[competencia][especificas]',
																	'textarea_rows' => 5)); ?>
		


	</div>
</div>


<script>
	jQuery(document).ready(function($) {
		var type = $('#meta_type').val();
		$('#meta_tipo_proceso option').each(function(index, el) {
			if (type == el.value) {
				el.setAttribute("selected", "");
			};
		});
		// No publicar si no se selecciona el tipo de proceso
		$('#publish').click(function(event) {
			if ($('#meta_tipo_proceso').val() == "") {
				event.preventDefault();
				alert("El tipo de proceso no puede estar vacio.");
			};
		});

		// function load()
		// {
		// 	var url = '<?php echo(plugin_dir_url(__FILE__ )); ?>';
		// 	$.get(url+$('#meta_tipo_proceso').val().toLowerCase()+".html", function(data) {
		// 		$('#loadForms').html(data);
		// 	});
		// }
		// $('#meta_tipo_proceso').change(function(event) {
		// 	load();
		// });
		// load();
	});
</script>


<!-- 
	EVALUAR AJAX CARGA FORMULARIO
 -->