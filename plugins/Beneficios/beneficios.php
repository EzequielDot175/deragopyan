<?php
/*
Plugin Name: Beneficios deragopyan
Description: 
Version: 1.0
Author: Ezequiel Romero
License: GPL2
*/
/*

*/

if (!class_exists("Beneficios")):
	/**
	* 
	*/
	class Beneficios
	{
		public $success = "";

		private $insert = array();
		private $update = array();
		private $logo = array();
		private $foto = array();
		private $table = "wp_beneficios";
		private $id ;

		private $upload_dir;

		public $link;

		const RAND_KEY_BENEFICIOS = "deragopyanBeneficios";

		
		public function __construct()
		{
			$this->upload_dir = wp_upload_dir();
			$this->link = $this->upload_dir["baseurl"]."/beneficios/";
			$plugin = plugin_basename(__FILE__);
			add_action("admin_menu", array($this,"addMenuBeneficios"));
			add_action("wp_print_scripts", array($this,"scripts"));
			add_action("wp_ajax_deletebeneficio", array($this,"delete"));
			add_action("wp_ajax_filterBySede", array($this,"filterBySede"));
			add_action("wp_ajax_filterBySede", array($this,"filterBySede"));
		}
		public static function activate(){}
		public static function deactivate(){}
		private function randomName(){
			$rand = (string)rand();
			return md5(RAND_KEY_BENEFICIOS.$rand);
		}
		private function getExtend($file){
			if(!empty($file["name"])):
				switch ($file["type"]):
					case 'image/png':
						return ".png";
						break;
					case 'image/gif':
						return ".gif";
						break;
					case 'image/jpeg':
						return ".jpg";
						break;
				endswitch;
			endif;
		}
		private function fileUpload($file){
			$upload = $this->upload_dir["basedir"]."/beneficios";
			foreach ($file as $k => $v):
				if(!empty($v["name"])):
					$name = $this->randomName().$this->getExtend($v);
					$this->insert[$k] = $name;
					move_uploaded_file($v["tmp_name"], $upload."/".$name);
				endif;
			endforeach;
		}
		private function save($a){
			global $wpdb;
			$row = $wpdb->insert($this->table,$a);
			$this->success = ($row > 0 ? "Beneficio creado correctamente" : "Lo sentimos, hubo un error en la creacion del beneficio. Reintente nuevamente");
		}
		private function saveChanges(){
			global $wpdb;
			$wpdb->update($this->table,$this->update,array("id" => $this->id));
		}
		public static function getBeneficiosBySede($withHtml = false){
			global $wpdb;
			$sql = "SELECT 
						wpsd.id,
					    wpsd.name,
					    COUNT(wpb.id) as cantidad
					FROM
						wp_sedes_degaropyan as wpsd
					LEFT JOIN
						wp_beneficios as wpb ON `wpb`.`sede-seleccion-option` = wpsd.id";
			if ($withHtml) {
				foreach($wpdb->get_results($sql) as $k => $v):
					echo "<li id='sede-beneficio-".$v->id."'>".$v->name." (".$v->cantidad.")</li>";
				endforeach;
			}else{
				return $wpdb->get_results($sql);
			}

		}
		public function saveBeneficio(){
			$vars = $_POST;

			
			if($vars["beneficios"] == 1):
				unset($vars["beneficios"]);
				if (isset($vars["sede-checkbox"])):
					unset($vars["sede-checkbox"]);
				endif;
				foreach($vars as $k => $v):
					$this->insert[$k] = sanitize_text_field($v);
				endforeach;
				$this->fileUpload($_FILES);
				$this->save($this->insert);
			endif;
		}
		public function getList(){
			global $wpdb;
			$rows = $wpdb->get_results("SELECT id,nombre,logo FROM wp_beneficios");
			return $rows;
		}
		
		public function scripts(){
			// register
			wp_register_style("beneficios-css", plugins_url("/css/beneficios.css", __FILE__ ) );
			wp_register_script("beneficios-js", plugins_url("js/beneficios.js", __FILE__ ) );

			//enque
			wp_enqueue_script("beneficios-js");
			wp_enqueue_style("beneficios-css");
		}
		public function imgLink($var){
			echo($this->link.$var);
		}
		public function addMenuBeneficios(){
			add_menu_page("Beneficios",
							"Beneficios",
							"manage_options",
							"beneficios-deragopyan",
							array($this,"index"),
							plugin_dir_url(__FILE__)."img/icon.png" 
							);
			add_submenu_page("beneficios-deragopyan",
			"Crear beneficio",
			"Crear beneficio",
			"manage_options",
			"beneficios-deragopyan-create",
			array($this,"create")
			);	
			add_submenu_page(null,
			"Editar beneficio",
			"Editar beneficio",
			"manage_options",
			"beneficios-deragopyan-edit",
			array($this,"edit")
			);		
		}
		public function getCurrent($id){
			global $wpdb;
			return $wpdb->get_results("SELECT * FROM wp_beneficios WHERE id = ".(int)$id);
		}
		private function updateFile($file){
			global $wpdb;
			$upload = $this->upload_dir["basedir"]."/beneficios";
			foreach ($file as $k => $v):
				if(!empty($v["name"])):
					$oldImage = $wpdb->get_var("SELECT ".$k." FROM wp_beneficios WHERE id='".$this->id."' ");
					unlink($upload."/".$oldImage);
					$name = $this->randomName().$this->getExtend($v);
					$this->update[$k] = $name;
					move_uploaded_file($v["tmp_name"], $upload."/".$name);
				endif;
			endforeach;
		}
		public function update(){
			if(isset($_POST["beneficios-update"])):
				unset($_POST["beneficios-update"]);
				$this->id = $_POST["bfi"];
				unset($_POST["bfi"]);
				foreach($_POST as $k => $v):
					$this->update[$k] = sanitize_text_field($v);
				endforeach;
					$this->updateFile($_FILES);
				$this->saveChanges();
				print("<script>window.location.href='?page=beneficios-deragopyan'</script>");
			endif;
		}
		public function delete(){
			if (isset($_POST["beneficio_id"])):
				global $wpdb;
				$row = $wpdb->delete($this->table,array("id" => (int)$_POST["beneficio_id"]));
				echo($row);
			endif;
			die();
		}
		public function getLatLng(){
			if(isset($_POST["getLtnLgn"])):
			
			endif;

			die();
		}

		public static function getData(){
			global $wpdb;
			return $wpdb->get_results("SELECT * FROM wp_beneficios");
		}
		// Paginas administrativas 
		public function index(){
			require $plugin."/inc/index.php";
		}
		public function create(){
			require $plugin."/inc/create.php";
		}
		public function edit(){
			require $plugin."/inc/edit.php";
		}
		public function filterBySede(){
			if(isset($_POST["sede"])):
				global $wpdb;
				$id = (int)$_POST["sede"];
				$sql = "SELECT * FROM `wp_beneficios` WHERE `sede-seleccion-option`= ".$id;
				echo json_encode($wpdb->get_results($sql));
			endif;
			die();
		}
	}
endif;

if(class_exists('Beneficios'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('Beneficios', 'activate'));
	register_deactivation_hook(__FILE__, array('Beneficios', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new Beneficios();

}
