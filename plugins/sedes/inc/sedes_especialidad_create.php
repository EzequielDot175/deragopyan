<?php function sedes_degaropyan_add_esp(){ ?>
<?php 
// POST BLOCK
	if(isset($_POST["submit"])):
		global $wpdb;

		if(!empty($_FILES["esp_icon"]["name"])):
			$file_name = $_FILES["esp_icon"]["name"];
			$file_path = $_FILES["esp_icon"]["tmp_name"];

			$number = rand(2,20);
			$extension = substr($file_name, -4);

			$newname = md5($number.md5($file_name)).$extension;

			$dir = wp_upload_dir();

			$upload = $dir["basedir"]."/sedes/";
			move_uploaded_file($file_path, $upload.$newname);
		else:
			$newname = "iconos-default.png";
		endif;

		

		$options = array(
					"esp_name" => sanitize_text_field( $_POST["esp_name"] ),
					"esp_icon" => $newname
					);

		$affected = $wpdb->insert("wp_sedes_especialidades", $options);

		if($affected > 0):
			echo('<div class="jw_admin_wrap">Especialidad creada correctamente<div>');
		endif;
	endif;
 ?>



	<div class="jw_admin_wrap">
		<h2>Crear especialidad</h2>
		<form action="" method="POST" enctype="multipart/form-data">
			<label for="input">Nombre de la especialidad</label>
			<input type="text" name="esp_name">
			<br>
			<label for="input">Seleccione un icono</label>
			<br>
			<input type="file" name="esp_icon">
			<br>
			<input type="hidden" name="submit" value="1">
			<input type="submit" value="Enviar">
		</form>
		<a href="?page=sedes_degaropyan_manager_especialidad">Volver</a>
	</div>
<?php } ?>