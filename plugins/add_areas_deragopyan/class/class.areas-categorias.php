<?php 

	/**
	* 
	*/
	class AreasCategoriasManager
	{
		private $table = "wp_areas_categorias_options";
		private $data = array();

		private $db;
		
		public function __construct()
		{	

		}
		// CRUD METHODS
		private function clear($data){
			foreach ($data as $key => $value):
				$realData[$key] = sanitize_text_field($value);
			endforeach;
			return $realData;
		}
		public function insert($data){
			global $wpdb;
			$insert = array(
				"name_option" => sanitize_text_field($data["thisType"]),
				"value_option" => sanitize_text_field($data["thisVal"])
				);
			 $wpdb->insert($this->table,$insert);
			 return $wpdb->insert_id;
		}
		public function delete($data){
			global $wpdb;
			return $wpdb->delete($this->table,array("id" => sanitize_text_field($data["id"])));
		}
		public function update($data){
			global $wpdb;
			$wpdb->update($this->table, array("value_option" => sanitize_text_field($data["thisVal"])) , array("id" => $data["id"]) );
		}
		public function getOptionsAreas($mode = 1,$selected = ""){
			global $wpdb;
			$sql = "SELECT id,value_option FROM $this->table WHERE name_option = 'area' ";
			$rows = $wpdb->get_results($sql);
			$this->fetchOptions($rows,$mode,$selected);
		}
		private function fetchOptions($data,$mode = 1,$selected){
			$html = "";
			switch ($mode) :
				case '1':
					foreach ($data as $k => $v):
						$html .= '<li>
							        <input type="text" disabled value="'.$v->value_option.'" class="inputEdit">
							        <input type="hidden" value="'.$v->id.'">
							        <button class="save">Guardar</button>
							        <button class="edit">Editar</button>
							        <button class="delete">Borrar</button>
							      </li>';
					endforeach;
				break;
				case '2':
					if(!empty($selected)):
						foreach ($data as $k => $v):
							if($v->id == $selected):
								$html .= '<option value="'.$v->id.'" selected>'.$v->value_option.'</option>';
							else:
								$html .= '<option value="'.$v->id.'">'.$v->value_option.'</option>';
							endif;
						endforeach;
					else:
						foreach ($data as $k => $v):
							$html .= '<option value="'.$v->id.'">'.$v->value_option.'</option>';
						endforeach;
					endif;
				break;
				
			endswitch;
			echo $html;
		}
		public function getOptionsCategorias($mode = 1, $selected = ""){
			global $wpdb;
			$sql = "SELECT id,value_option FROM $this->table WHERE name_option = 'categoria' ";
			$rows = $wpdb->get_results($sql);
			$this->fetchOptions($rows,$mode,$selected);
			
		}
		public function updateUser($data){
			$update = array(sanitize_text_field($data["option"]) => sanitize_text_field($data["value"]));
			$id = array("id" => $data["id"]);
			global $wpdb;
			$wpdb->update("wp_users", $update, $id);
			echo("Modificado");
		}
		public function getUsers(){
			global $wpdb;
			$rows = $wpdb->get_results('SELECT 
			                                usr.id as id,
			                                usr.user_area as area,
			                                meta.meta_value as nickname,
			                                usr.user_categoria as categoria
			                              FROM 
			                                wp_users as  usr
			                              LEFT JOIN
			                                wp_usermeta as meta ON meta.user_id = usr.id 
			                              WHERE 
			                                meta.meta_key = "nickname"');
			  return $rows;
		}

	}



 ?>