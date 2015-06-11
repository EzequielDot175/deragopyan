<?php 

	/**
	* 
	*/
	class D_Empleado
	{
		private static $data;
		private static $table = "wp_directorio";
		private static $format_data;
		private static $file_name;
		private static $success = "";
		private static $currentUserData;
		private static $current_file_image;
		private static $userDetails;


		public function __construct()
		{	
			add_action("wp_ajax_detailsbyid", array($this,"detailsbyid") );
			add_action("wp_ajax_nopriv_detailsbyid", array($this,"detailsbyid") );
		}
		public static function add($vars,$photo = null){
			if ($vars["addEmployer"] == 1) :
				self::$data = $vars;
				if(!empty($photo["foto"]["name"])):
					$file = self::upload($photo["foto"]["tmp_name"],$photo["foto"]["type"]);
				endif;
				if(isset($file)):
					self::format(true);
					self::insert();
					self::$success = "Perfil creado correctamente";
				else:
					self::format();
					self::insert();
					self::$success = "Perfil creado correctamente";
				endif;	
			endif;
		}
		private static function insert(){
			global $wpdb;
			$wpdb->insert("wp_directorio", self::$format_data);
		}
		public static function update($vars,$photo){
			if ($vars["editEmployeer"] == 1) :
				global $wpdb;
				$file = false;
				$id = (int)$vars["employeer"];
				if (!empty($_FILES["foto"]["name"])) :
					$file = self::upload($photo["foto"]["tmp_name"],$photo["foto"]["type"],true,$vars["currentImg"]);
				endif;
				self::$data = $vars;
				self::$current_file_image = $vars["currentImg"];
				self::format($file,true);
				$affected = $wpdb->update("wp_directorio", self::$format_data, array("ID" => $id));
				if ($affected > 0) :
					self::$success = true;
				else:
					self::$success = "Error, intente nuevamente";
				endif;
			endif;
		}
		private static function randomName($type){
			$rand = (string)rand(5000, 10000);
			$name = md5($rand);
			if (strpos($type, "jpeg")) {
				$name .= ".jpg";
				self::$file_name = $name;
				return $name;
			}elseif (strpos($type, "png")) {
				$name .= ".png";
				self::$file_name = $name;
				return $name;
			}
			else{
				return new WP_Error( 'broke', __( "Archivo no valido") );
			}
		}
		private static function clean($var){
			return sanitize_text_field($var);
		}
		public static function success($isBoolean = false){
			if (!empty(self::$success) && !$isBoolean ) :
				echo(self::$success);
			else:
				return self::$success;
			endif;
		}
		private static function upload($tmp,$type,$isUpload = false,$filename = ""){
			if ($isUpload && $filename != "default.png") :
				$link  = "../wp-content/uploads/directorio/".$filename;
				unlink($link);
			endif;
			return move_uploaded_file($tmp, DIRECTORIO_UPLOADS_IMAGES.self::randomName($type));

		}
		private static function format($file = false,$isUpload = false){
			self::$format_data = array(
				"dir_puesto" 		=> self::clean(self::$data["puesto"]),
				"dir_sede" 			=> self::clean(self::$data["sede"]),
				"dir_gerencia_area" => self::clean(self::$data["gerencia-area"]),
				"dir_grupo" 		=> self::clean(self::$data["grupo"]),
				"dir_interno" 		=> self::clean(self::$data["interno"]),
				"dir_celular" 		=> self::clean(self::$data["celular"]),
				"dir_mail"			=> self::clean(self::$data["mail"]),
				"dir_fecha_nac" 	=> self::clean(self::$data["fecha-nac"]),
				"dir_num_legajo" 	=> self::clean(self::$data["num-legajo"]),
				"dir_nombre" 		=> self::clean(self::$data["nombre"]),
				"dir_apellido" 		=> self::clean(self::$data["apellido"]),
				"dir_foto"			=> "default.png"				
				);
			$keywords = "";
			foreach (self::$format_data as $k => $v):
				if($k != "dir_puesto" && $k != "dir_sede" && $k != "dir_gerencia_area" && $k != "dir_grupo" && $k != "dir_foto"):
					$keywords .= " ".$v." ";
				endif;
			endforeach;
			self::$format_data["dir_keywords"] = $keywords;

			if($file):
				self::$format_data["dir_foto"] = self::clean(self::$file_name);
			endif;
			if ($file == false && $isUpload == true) :
				unset(self::$format_data["dir_foto"]);
			endif;
		}
		public function detailsById(){
			global $wpdb;

			print_r($_POST);
			die();
		}
		public static function getDirectorioAdmin($onlyData = false){
			global $wpdb;
			$rows = $wpdb->get_results("SELECT 
									wpd.id,
									wpd.dir_nombre,
								    wpd.dir_apellido,
								    wpd.dir_mail,
								    wpd.dir_foto,
								    wpdo.value_option   
								    FROM `wp_directorio` as wpd
								    LEFT JOIN wp_directorio_options as wpdo ON wpdo.id = wpd.dir_puesto");
			if($onlyData == false):
			foreach ($rows as $k => $v):
			?>
			<div class="row">
				<div class="cell photo">
					<img src="<?php echo(DIRECTORIO_LINK_IMAGES.$v->dir_foto) ?>" alt="<?php $v->dir_nombre ?>" title="<?php echo($v->dir_nombre) ?>" height="60" width="60">
				</div>
				<div class="cell name">
					<?php print($v->dir_nombre." ".$v->dir_apellido) ?>
				</div>
				<div class="cell workposition">
					<?php print($v->value_option) ?>
				</div>
				<div class="cell mail">
					<?php print($v->dir_mail) ?>
				</div>
				<div class="cell actions">
					<div class="center">
						<a href="?page=editar-perfil-directorio&pid=<?php print($v->id) ?>" >Editar</a>
						<a href="?page=directorio-borrar-perfil&pid=<?php print($v->id) ?>" class="delete">Borrar</a>
					</div>
				</div>
			</div>
			<?php
			endforeach;
			else:
				return $rows;
			endif;

		}
		public static function front(){
			global $wpdb;
			$rows = $wpdb->get_results("SELECT 
									wpd.id,
									wpd.dir_nombre,
								    wpd.dir_apellido,
								    wpd.dir_foto,
								    wpd.dir_foto,
								    wpdo.value_option as puesto,
								    wpdog.value_option as gerencia,
                                    wpsd.name as sede
								    FROM `wp_directorio` as wpd
								    LEFT JOIN wp_directorio_options as wpdo ON wpdo.id = wpd.dir_puesto
								    LEFT JOIN wp_directorio_options as wpdog ON wpdog.id = wpd.dir_gerencia_area
                                    LEFT JOIN wp_sedes_degaropyan as wpsd ON wpsd.id = wpd.dir_sede
								    ",ARRAY_A );

			$gerencias = array();
			foreach($rows as $k => $v):
				if(!array_keys($gerencias,$v["gerencia"])):
					$gerencias[] = $v["gerencia"];
				endif;
			endforeach;

			foreach($rows as $k => $v):
				$num = array_search($v["gerencia"], $gerencias);
				$filtro[$gerencias[$num]][] = $v;
			endforeach;
			ksort($filtro);
			return $filtro;
			
		}
		public static function getUser($id){
			global $wpdb;
			$result = $wpdb->get_results("SELECT * FROM wp_directorio WHERE id = ".(int)$id);
			return $result[0];
		}
		public static function getUserDetails($id){
			global $wpdb;
			$sql = "SELECT 
						wpd.dir_interno as interno,
					    wpd.dir_celular as celular,
					    wpd.dir_mail as email,
					    wpd.dir_foto as foto,
					    wpd.dir_fecha_nac as nacimiento,
					    wpd.dir_num_legajo as legajo,
					    wpd.dir_nombre as nombre,
					    wpd.dir_apellido as apellido,
						wpdo1.value_option as puesto,
					    wpdo2.value_option as gerencia,
					    wpdo3.value_option as grupo,
                        wsdp.name as sede
					FROM 
						wp_directorio as wpd
						LEFT JOIN wp_directorio_options AS wpdo1 ON wpdo1.id = wpd.dir_puesto
						LEFT JOIN wp_directorio_options AS wpdo2 ON wpdo2.id = wpd.dir_gerencia_area
						LEFT JOIN wp_directorio_options AS wpdo3 ON wpdo3.id = wpd.dir_grupo
                        LEFT JOIN wp_sedes_degaropyan AS wsdp ON wsdp.id = wpd.dir_sede
					WHERE wpd.id = ".(int)$id;
			self::$userDetails = $wpdb->get_results($sql);
			self::fetchDetails();
		}
		private static function setDataFetch($var,$name){
			if(!empty($var)):
				return "<li><span>".$name."</span> ".$var."</li>";
			else:
				return "";
			endif;
		}
		public static function fetchDetails(){
			$datos = self::$userDetails[0];
			$date = new DateTime($datos->nacimiento);
			$nombre = 	(!empty($datos->nombre) ? $datos->nombre : "");
			$apellido = (!empty($datos->apellido) ? $datos->apellido : "");
			$options = "";
			$options .= self::setDataFetch($datos->gerencia,"Gerencia/área");
			$options .= self::setDataFetch($datos->grupo,"Grupo de trabajo");
			$options .= self::setDataFetch($datos->puesto,"Puesto");
			$options .= self::setDataFetch($datos->sede,"Sede");
			$options .= self::setDataFetch($datos->interno,"Interno");
			$options .= self::setDataFetch($datos->celular,"Celular");
			$options .= self::setDataFetch($datos->email,"Mail");
			$options .= self::setDataFetch($date->format("d/m/Y"),"Fecha nac");
			$options .= self::setDataFetch($datos->legajo,"Núm legajo");
			
			$html = '
			<div class="directorio-details-users" >
				<button class="reset-query">Volver</button>

				<div class="container-details" style="background:url('.DIRECTORIO_LINK_IMAGES.$datos->foto.')" >
					<h3>'.$apellido.' '.$nombre.'</h3>
				</div>
				<div class="info">
					<ul>
						'.$options.'
					</ul>
					<button id="button-dir-contacto">Enviar mensaje</button>
				</div>
			</div>
			<div class="directorio-contacto-form">
				<form action="">
					<a href="" class="closeFormDirectorio" ></a>
					<h3>Contactar a '.$apellido.' '.$nombre.'</h3>
					<input type="text" placeholder="Nombre">
					<input type="text" placeholder="Email">
					<textarea name="" id="" cols="30" rows="10"></textarea>
					<input type="submit">
				</form>
			</div>
			';
			echo($html);
		}
	}
 ?>