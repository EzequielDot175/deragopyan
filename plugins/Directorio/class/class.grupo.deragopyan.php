<?php 
	
	/**
	* 
	*/
	class D_Grupos
	{
		private static $datos;
		private static $table = "wp_directorio_options";
		private static $option_name = "grupos de trabajo";
		private static $optionTableCount = "dir_grupo";
		private static $success;
		// private

		function __construct(){

		}
		public static function newOption($data){
			if ($data["directorio"] == 1):
				self::$datos = $data;
				self::insert();
				self::$success = "Grupo creado correctamente";
			endif;
		}
		public static function insert($value){
			global $wpdb;
			$wpdb->insert(self::$table, array("name_option" => self::$option_name, "value_option" => sanitize_text_field(self::$datos["directorio-value"])));
		}
		public static function success(){
			echo(self::$success);
		}
		private static function getCountOption($id){
			global $wpdb;
			$sql = "SELECT COUNT(id) FROM wp_directorio WHERE ".self::$optionTableCount." = ".$id;
			$result =  $wpdb->get_var($sql);
			if($result > 0):
				return "(".$result.")";
			endif;
		}
		public static function getOptions($id = null,$onlydata = false,$withCount = false){
			global $wpdb;
			$row = $wpdb->get_results("SELECT * FROM ".self::$table." WHERE name_option = '".self::$option_name."'");
			if(!$onlydata):
				$html = "";
				if (!empty($row) && !is_null($row)) :
					if(!is_null($id)):
						foreach ($row as $key => $value) :
							if($value->id == $id):
								$html .= '<option value="'.$value->id.'" selected>'.$value->value_option.'</option>';
							else:
								$html .= '<option value="'.$value->id.'">'.$value->value_option.'</option>';
							endif;
						endforeach;
					else:
						if($withCount):
							foreach ($row as $key => $value) :
								
								$html .= '<option value="'.$value->id.'">'.$value->value_option.' '.self::getCountOption($value->id).'</option>';
								
							endforeach;
						else:
							foreach ($row as $key => $value) :
								$html .= '<option value="'.$value->id.'">'.$value->value_option.'</option>';
							endforeach;
						endif;
					endif;
				endif;
				echo($html);
			else:
				return $row;
			endif;
		}
		
		public static function dissappear($id){
			global $wpdb;
			$wpdb->delete(self::$table, array("id" => (int)$id ) );
		}
		public static function edit($id,$value){
			global $wpdb;
			$wpdb->update(self::$table, array("value_option" => (string)$value ), array("id" => (int)$id ) );
		}
		
	}

	add_action( 'wp_ajax_grupos', 'grupos' );
	function grupos(){
		if($_POST["action"] == "grupos"):
			if($_POST["actionOption"] == "edit"):
				D_Grupos::edit($_POST["id"],$_POST["value"]);
			elseif($_POST["actionOption"] == "delete"):
				D_Grupos::dissappear($_POST["id"]);
			endif;
		endif;
		die();
	}

 ?>