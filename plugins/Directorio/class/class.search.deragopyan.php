<?php 

/**
* 
*/
class DirectorioSearch
{
	private static $params;
	private static $keywords;
	private static $sql;
	private static $data;
	function __construct(){}
	public static function search($data){
		self::$params = $data["datos"];
		self::$keywords = $data["keys"];
		self::filter();
		self::keys();
		self::initialData();
		self::format();
		self::fetch();
	}
	private static function c($value){
		return sanitize_text_field($value);
	}
	private static function filter(){
		$count = 0;
		self::$sql = "SELECT 
						wpd.id,
						wpd.dir_nombre,
						wpd.dir_apellido,
						wpd.dir_foto,
						wpd.dir_foto,
						wpdo.value_option as puesto,
						wpdog.value_option as gerencia
						FROM `wp_directorio` as wpd
						LEFT JOIN wp_directorio_options as wpdo ON wpdo.id = wpd.dir_puesto
						LEFT JOIN wp_directorio_options as wpdog ON wpdog.id = wpd.dir_gerencia_area
						";
		foreach (self::$params as $key => $v):
			if (!empty($v["value"])):
				if($count == 0):
					self::$sql .= " WHERE ".$v["name"]." = ".self::c($v["value"]);
					$count++;
				else:
					self::$sql .= " AND ".$v["name"]." = ".self::c($v["value"]);
				endif;
			endif;
		endforeach;
	}
	private static function keys(){
	if(!empty(self::$keywords[0])):
		if (strpos(self::$sql, "WHERE")):
			foreach(self::$keywords as $k => $v):
				if($k == 0):
					self::$sql .=" AND dir_keywords LIKE ('%".self::c($v)."%'";
				else:
					self::$sql .=" AND '%".self::c($v)."%'";
				endif;
			endforeach;
					self::$sql .= ")";
		else:
			self::$sql .= " WHERE dir_keywords ";
			foreach(self::$keywords as $k => $v):
				if($k == 0):
					self::$sql .=" LIKE ('%".self::c($v)."%'";
				else:
					self::$sql .=" OR '%".self::c($v)."%'";
				endif;
			endforeach;
					self::$sql .= ")";
		endif;
	endif;
	}
	private static function initialData(){
		global $wpdb;
		self::$data = $wpdb->get_results(self::$sql,ARRAY_A);
	}
	private static function format(){
			$gerencias = array();
			// print_r(self::$data);
			foreach(self::$data as $k => $v):
				if(!array_keys($gerencias,$v["gerencia"])):
					$gerencias[] = $v["gerencia"];
				endif;
			endforeach;
			foreach(self::$data as $k => $v):
				$num = array_search($v["gerencia"], $gerencias);
				$filtro[$gerencias[$num]][] = $v;
			endforeach;
			ksort($filtro);
			self::$data = $filtro;
	}
	private static function fetch(){
		$html = '';
		foreach(self::$data as  $kGerencia => $vGerencia):
		
		$html .='<ul class="directorio-container">
					<h1>'.$kGerencia.'</h1>
					<div class="directorio-content-row">';
			foreach ($vGerencia as $k => $v):
				$html .=' <li style="background:url('.DIRECTORIO_LINK_IMAGES.$v["dir_foto"].')">
						<a href="#" class="directorio-profile-user">
							<div class="apellido">'.$v["dir_apellido"].'</div>
							<div class="nombre">'.$v["dir_nombre"].'</div>
							<div class="puesto">'.$v["puesto"].'</div>
							<input type="hidden" value="'.$v["id"].'" class="dir-get">
						</a>
					</li>';
			endforeach;
				$html .= '</div>
				</ul>';
		endforeach;

		echo($html);
	}

}



add_action( 'wp_ajax_nopriv_directorio_search', 'directorio_search' );
add_action( 'wp_ajax_directorio_search', 'directorio_search' );
	function directorio_search(){
		if($_POST["action"] == "directorio_search" && !isset($_POST["detail_user"])):
			DirectorioSearch::search($_POST);
		else:
			D_Empleado::getUserDetails($_POST["id_user"]);		
		endif;
		die();
	}
 ?>