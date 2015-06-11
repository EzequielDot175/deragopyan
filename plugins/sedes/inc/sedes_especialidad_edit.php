<?php function sedes_degaropyan_edit_esp(){ ?>
<?php 
// POST BLOCK
	global $wpdb;
	if(isset($_POST["submit"])):
		if(!empty($_FILES["esp_icon"]["name"])):

			$file_name = $_FILES["esp_icon"]["name"];
			$file_path = $_FILES["esp_icon"]["tmp_name"];

			$number = rand(2,20);
			$extension = substr($file_name, -4);
			// !------------------------
			$newname = md5($number.md5($file_name)).$extension;

			$dir = wp_upload_dir();

			$upload = $dir["basedir"]."/sedes/";

			move_uploaded_file($file_path, $upload.$newname);

			$options = array(
					"esp_name" => sanitize_text_field( $_POST["esp_name"] ),
					"esp_icon" => $newname,
					);
		else:
			$options = array( "esp_name" => sanitize_text_field( $_POST["esp_name"] ) );
		endif;
		
		$affected = $wpdb->update("wp_sedes_especialidades",$options, array("id" => (int)$_GET["id"]));
		if($affected > 0):
			echo('<div class="jw_admin_wrap">Especialidad editada correctamente<div>');
		endif;
	endif;
	$byId = $wpdb->get_results("SELECT esp_name,esp_icon FROM wp_sedes_especialidades WHERE id =".(int)$_GET["id"])[0];

 ?>



	<div class="jw_admin_wrap">
		<h2>Editar especialidad</h2>
		<form action="" method="POST" enctype="multipart/form-data">
			<label for="input">Nombre de la especialidad</label>
			<input type="text" name="esp_name" value="<?php echo($byId->esp_name) ?>">
			<br>
			<label for="input">Seleccione un icono</label>
			<br>
			<img src="<?php echo(IMG_SEDES.$byId->esp_icon) ?>" alt="" height="100" width="100">
			<br>
			<input type="file" name="esp_icon">
			<br>
			<input type="hidden" name="submit" value="1">
			<input type="submit" value="Enviar">
		</form>
		<a href="?page=sedes_degaropyan_manager_especialidad">Volver</a>
	</div>



<?php } ?>