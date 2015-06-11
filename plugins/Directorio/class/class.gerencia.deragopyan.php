<?php 
	
	/**
	* 
	*/
	class D_Gerencia
	{
		private static $datos;
		private static $table = "wp_directorio_options";
		private static $option_name = "gerencia";
		private static $ajax_name = "gerencia";
		private static $optionTableCount = "dir_gerencia_area";
		private static $success;
		// private

		function __construct(){

		}
		public static function newOption($data){
			if ($data["directorio"] == 1):
				self::$datos = $data;
				self::insert();
				self::$success = "Gerencia creada correctamente";
			endif;
		}
		private static function insert($value){
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
		private static function dissappear($id){
			global $wpdb;
			$wpdb->delete(self::$table, array("id" => (int)$id ) );
		}
		private static function edit($id,$value){
			global $wpdb;
			$wpdb->update(self::$table, array("value_option" => (string)$value ), array("id" => (int)$id ) );
		}
		public static function getAjaxName(){
			return self::$ajax_name;
		}
		public static function getAjaxAction(){
			return 'wp_ajax_'.self::$ajax_name;
		}
		
	}

	add_action( D_Gerencia::getAjaxAction() , D_Gerencia::getAjaxName() );
	function gerencia(){
		if($_POST["action"] == D_Gerencia::getAjaxName() ):
			if (isset($_POST["edit"])) :
				D_Gerencia::edit($_POST["id"],$_POST["edit"]);
			elseif(isset($_POST["unset"])):
				D_Gerencia::dissappear($_POST["id"]);
			endif;

		endif;
		die();
	}


 ?>