<?php
/*
Plugin Name: Organigrama deragopyan
Plugin URI: https://github.com/fyaconiello/wp_plugin_template
Description: A simple wordpress plugin template
Version: 1.0
Author: Francis Yaconiello
Author URI: http://www.yaconiello.com
License: GPL2
*/
/*

*/

if(!class_exists('OrgranigramaDeragopyan'))
{
	class OrgranigramaDeragopyan
	{
		
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			// Initialize Settings
			//require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			//$WP_Plugin_Template_Settings = new LineaDeTiempoDeragopyanSettings();

			// Register custom post types
			
			$plugin = plugin_basename(__FILE__);
			add_action("wp_print_scripts", array($this,"addStylesOrgani"));
			add_action("wp_print_scripts", array($this,"addScriptOrgani"));
			add_action('admin_menu',array($this, "addMenuOrganigrama"));
			add_action( 'wp_ajax_ajaxfilterpersonal',array($this,"ajaxfilterpersonal") );
			add_action( 'wp_ajax_xhrajax',array($this,"xhrajax") );
			add_action( 'wp_ajax_nopriv_getfrontorgani',array($this,"getFrontOrgani") );
			add_action( 'wp_ajax_getfrontorgani',array($this,"getFrontOrgani") );


		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public function addMenuOrganigrama(){
			add_menu_page( "Organigrama",
				"Organigrama",
				"manage_options",
				"organigrama-deragopyan",
				array($this,"homeOrganigrama"),
				plugin_dir_url( __FILE__ ) . 'img/organi.png'
				);
			add_submenu_page( 'organigrama-deragopyan', 'Crear Organigrama', 'Crear Organigrama', 'manage_options', 'organigrama-deragopyan-create', array($this,"createOrganigrama") );	
			add_submenu_page( null, 'Editar Organigrama', 'Editar Organigrama', 'manage_options', 'organigrama-deragopyan-edit', array($this,"editOrganigrama") );	
		}
		public function addStylesOrgani(){
			wp_register_style("OrganigramaDeragopyan", plugins_url( "css/organigramaDeragopyan.css",__FILE__ ) );
			wp_enqueue_style("OrganigramaDeragopyan");
		}
		public function addScriptOrgani(){
			wp_register_script("organigrama-script-1", plugins_url( "js/organigramaDeragopyan.js", __FILE__ ) );
			wp_register_script("organigrama-script-2", plugins_url( "js/organigoogle.js", __FILE__ ) );
			wp_enqueue_script("organigrama-script-1");
			wp_enqueue_script("organigrama-script-2");
		}
		public function ajaxFilterPersonal(){
			global $wpdb;
			$sql = "SELECT dir_nombre,dir_apellido,id FROM wp_directorio";

			if (!empty($_POST["search"])):
				$sql .= " WHERE ";
			endif;

			// searchFromDirectory
			if (isset($_POST["search"])):
				$i = 0;
				if(!empty($_POST["search"])):
					foreach ($_POST["search"] as $k => $v):
						if($i == 0):
							$sql .= sanitize_text_field($v["name"])." = ".sanitize_text_field($v["value"]);
							$i++;
						else:
							$sql .= " AND ".sanitize_text_field($v["name"])." = ".sanitize_text_field($v["value"]);
						endif;
					endforeach;
				endif;
				$rows = $wpdb->get_results($sql);
				$html = "";
				foreach ($rows as $k => $v):
					$html .= "<option value='".$v->id."'>".$v->dir_apellido." ".$v->dir_nombre."</option>";
				endforeach;
				print($html);

    		elseif(isset($_POST["searchFromDirectory"])):
    			if(!empty($_POST["searchFromDirectory"])):
	    			$sql = "SELECT dir_foto FROM wp_directorio WHERE id = ".sanitize_text_field($_POST["searchFromDirectory"]);
	    			$results = $wpdb->get_var($sql);
	    			print(DIRECTORIO_LINK_IMAGES.$results);
	    		else:
	    			print("http://www.deragopyan.com/wp-content/uploads/directorio/default.png");
    			endif;
    		elseif(isset($_POST["frontOrgani"])):
    			$front = json_encode($_POST["frontOrgani"]);
    			$back = json_encode($_POST["backOrgani"]);
    			$name = sanitize_text_field($_POST["name_organi"]);
    			$insert = array(
    				"name"=>$name,
    				"data_front" => $front,
    				"data_edit" => $back
    				);
    			// print_r($_POST["frontOrgani"]);
    			// print_r($back);
    			$affected = $wpdb->insert("wp_organigrama",$insert);
    			print($affected);
    		elseif(isset($_POST["editDataOrgani"])):
    			$front = json_encode($_POST["frontEditOrgani"]);
    			$back = json_encode($_POST["backEditOrgani"]);
    			$name = sanitize_text_field($_POST["name_organi"]);
    			$id = $_POST["editOrganiId"];
    			$update = array(
    				"name" => $name,
    				"data_front" => $front,
    				"data_edit" => $back
    				);
    			// print_r($update);
    			$row = $wpdb->update("wp_organigrama",$update, array("id"=> $id) );
    			print($row);
    		elseif(isset($_POST["unsetOrgani"])):
    			$row = $wpdb->delete("wp_organigrama",array("id" => (int)$_POST["unsetOrgani"]));
    			print($row);

			endif;

			die();
		}
		private function decode($row){
			$decode = json_decode($row);
			$newValue = array();
			foreach ($decode as $key => $value) {
				$newValue[$key][0]["f"] = stripslashes($value[0]->f);
				$newValue[$key][0]["v"] = stripslashes($value[0]->v);
				$newValue[$key][1] = $value[1];
				$newValue[$key][2] = $value[0];
			}
			return json_encode($newValue);
		}
		public function getFrontOrgani(){
			global $wpdb;
			if (isset($_POST["getOrganiId"])):
				$id = (int)$_POST["getOrganiId"];
				$sql = "SELECT data_front FROM wp_organigrama WHERE id= ".$id;
				$row = $wpdb->get_var( $sql );
				print($this->decode($row));

				
			elseif(isset($_POST["getOrganiDefault"])):
				$row = $wpdb->get_var("SELECT data_front FROM wp_organigrama ORDER BY id DESC");
				print($this->decode($row));
			endif;
			die();
		}

		public static function getMenuOrgani(){
			$html = "<ul>";
			foreach(self::getOrganiList() as $k => $v):
				$html.= "<li><a href='#".$v->id."' class='getAjaxOrgani'>".$v->name."</a></li>";
			endforeach;
			$html .= "</ul>";
			echo($html);
		}
		public static function getOrganiList(){
			global $wpdb;
			return $wpdb->get_results("SELECT id,name FROM  wp_organigrama");
		}
		public function editOrganigrama(){
			require ( plugin_dir_path( __FILE__ )."/inc/organigrama-edit.php" );
		}
		public static function activate()
		{
			// Do nothing
		} // END public static function activate
		public function homeOrganigrama(){
			require ( plugin_dir_path( __FILE__ )."/inc/organigrama-home.php" );
		}
		public function createOrganigrama(){
			require ( plugin_dir_path( __FILE__ )."/inc/organigrama-create.php" );
		}
		public function xhrajax(){
			if (isset($_POST["currentOrganiId"])):
				global $wpdb;
			$id = (int)$_POST["currentOrganiId"];
				$result = $wpdb->get_var("SELECT data_edit FROM wp_organigrama WHERE id = ".$id);
				$decode = json_decode($result);

				$newValue = array();
				foreach ($decode as $key => $value) {
					$newValue[$key][0]["f"] = stripslashes($value[0]->f);
					$newValue[$key][0]["v"] = stripslashes($value[0]->v);
					$newValue[$key][1] = $value[1];
					$newValue[$key][2] = $value[0];
				}
				print(json_encode($newValue));
			endif;

			die();
		}
		public static function getOrganiName($id){
			global $wpdb;
			echo($wpdb->get_var("SELECT name FROM wp_organigrama WHERE id = ".$id));

		}
		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			// Do nothing
		} // END public static function deactivate

		// Add the settings link to the plugins page
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_plugin_template">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	} // END class WP_Plugin_Template
} // END if(!class_exists('WP_Plugin_Template'))

if(class_exists('OrgranigramaDeragopyan'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('OrgranigramaDeragopyan', 'activate'));
	register_deactivation_hook(__FILE__, array('OrgranigramaDeragopyan', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new OrgranigramaDeragopyan();

}
