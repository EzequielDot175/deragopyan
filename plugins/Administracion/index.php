<?php 


/*
Plugin Name: Administracion de usuarios deragopyan
Plugin URI: 
Description: 
Version: 1.0
Author: Ezequiel Romero
Author URI: 
*/

if(!class_exists("Administracion")):

	/**
	* 
	*/
	class Administracion
	{
		
		public function __construct()
		{
			add_action("init", array($this,"removeRole") );
			add_action("init", array($this,"setRoles") );
			add_action("wp_print_scripts",array($this,"addScript") );
			add_action("wp_print_scripts",array($this,"addScriptTemplate") );
			add_action("wp_ajax_administradorP", array($this,"Ajax"));

            add_action("wp_ajax_detailsbyid_dir" , array($this,"getDetailsByIdDirectorio"));
            add_action("wp_ajax_nopriv_detailsbyid_dir" , array($this,"getDetailsByIdDirectorio"));
			// add_filter('admin_menu',array($this,"be_menu_extras"), 10, 2);
			add_filter('admin_init',array($this,"removeMenuByUser") );

		}

		
		public function adRoles(){
			require plugin_dir_path(__FILE__)."inc/procedimientos.php";
		}
		public function addScript(){
			if(is_admin()):
				wp_register_style("admin-plug-css", plugins_url("css/administrador-plugin.css", __FILE__ ) );
				wp_register_style("admin-plug-css-admin", plugins_url("css/admin/admin.css", __FILE__ ) );
				wp_enqueue_style("admin-plug-css");
				wp_enqueue_style("admin-plug-css-admin");

				wp_register_script("administrador-plugin", plugins_url("js/administrador-plugin.js", __FILE__ ) );
				wp_enqueue_script("administrador-plugin");

				wp_enqueue_style("datepicker-1", 
					plugins_url("css/jquery-ui.min.css", __FILE__ ));
				wp_enqueue_style("datepicker-2", 
					plugins_url("css/jquery-ui.structure.min.css", __FILE__ ));
				wp_enqueue_style("datepicker-3", 
					plugins_url("css/jquery-ui.theme.min.css", __FILE__ ));
				
			endif;
		}
		public function addScriptTemplate(){
				wp_register_script("templates-plugin", plugins_url("js/templates.js", __FILE__ ) );
				wp_enqueue_script("templates-plugin");
		}
		public function getDetailsByIdDirectorio()
		{
			global $wpdb;
			$sql = "SELECT 
						wpd.dir_interno as interno,
					    wpd.dir_celular as celular,
					    wpd.dir_mail as email,
					    wpd.dir_foto as foto,
					    date_format(wpd.dir_fecha_nac,'%d/%m/%Y') as nacimiento,
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
					WHERE wpd.id = ".(int)$_POST["id"];
			$row = $wpdb->get_results($sql);
			echo(json_encode($row));
			die();
		}
		private function getPreferences($id){
			$preferences = get_option( "usuario-procedimientos-".$id, "notValue" );
			echo $preferences;
		}

		private function setPreferences($id,$values){
			$preferences = get_option( "usuario-procedimientos-".$id, "notValue" );
			if($preferences == "notValue"):
				add_option("usuario-procedimientos-".$id, (string)$values);
			else:
				update_option("usuario-procedimientos-".$id, (string)$values );
			endif;
		}
		private function setLimits(){
			$user = wp_get_current_user();
			$id = $user->id;
			$row = get_option("usuario-procedimientos-".$id, "notValue" );
			echo $row;
		}
		public function Ajax(){
			if(isset($_POST["action"])):
				switch ($_POST["trueAction"]) {
					case 'getPreferences':
						$this->getPreferences((int)$_POST["id"]);
						break;
					case 'setPreferences':
						$this->setPreferences((int)$_POST["id"],(string)$_POST["values"]);
						break;
					case 'setLimits':
						$this->setLimits();
						break;
					default:
						# code...
						break;
				}
			endif;
			die();
		}


		public function removeMenuByUser() {
            global $menu;
            global $current_user;

            $perfil = $menu[70];
            unset($menu[70]);
            array_push($menu, $perfil);

            $role = $current_user->roles[0];

            
           		switch ($role) {
           			case 'deragopyan-master':
           				
           				remove_menu_page("edit.php");
           				remove_menu_page("edit.php?post_type=postlineadetiempo" );
           				remove_menu_page("edit-comments.php" );
           				remove_menu_page("edit-comments.php" );
           				remove_menu_page("options-general.php" );
           				remove_menu_page("sedes_degaropyan_manager" );
           				remove_menu_page("tools.php" );
           				remove_menu_page("index.php" );
           				break;

           			default:

           				break;
           		}

            return $menu;
        }
		public function fetchProcedimientosUsers(){
			$users = get_users();
				$html = '';
			foreach($users as $k => $v):
				if(is_numeric(strpos($v->roles[0],"procedimientos"))):
					$html .= '<div class="labels fetch">';
					$rol = explode("-", $v->roles[0]);
					
					$html .= '<div class="name">
									'.$v->data->display_name.'
								</div>
								<div class="username">
									'.$v->data->user_login.'
								</div>
								<div class="rol">
									<span>'.$rol[0].'</span> - <span>'.$rol[1].'</span> 
								</div>
								<div class="controls">
									<input type="hidden" name="id" value="'.$v->data->ID.'">
									<button class="btn-details">Ver areas</button>
								</div>';
					$html .= "</div>";
				endif;
			endforeach;
				echo $html;

		}
		public function getProcTaxonomy(){
			global $wpdb;
			$sql = 'SELECT 
						wpt.name as name,
						wpt.term_id as id
					FROM 
						wp_term_taxonomy as wptt
					LEFT JOIN
						wp_terms as wpt ON wpt.term_id = wptt.term_taxonomy_id 
					WHERE
						wptt.taxonomy = "procedimientos-categorias" and wptt.parent = 0';
			return $wpdb->get_results($sql,ARRAY_A);
		}
		public function removeRole(){
			remove_role("author");
			remove_role("contributor");
			remove_role("subscriber");
			remove_role("editor");
		}
		public function setRoles(){

			add_role( 'deragopyan-master', "Deragopyan Master", array() );

			add_role( 'noticias-editor', "Noticias - Editor", array());
			add_role( 'noticias-aprobador', "Noticias - Aprobador", array());

			add_role( 'procedimientos-editor', "Procedimientos - Editor", array());
			add_role( 'procedimientos-aprobador', "Procedimientos - Aprobador", array());
			add_role( 'procedimientos-publicador', "Procedimientos - Publicador", array());

			//  noticias - editor
			$editor_not = get_role('noticias-editor');
			$editor_not->add_cap('read');
			$editor_not->add_cap('edit_posts');
			$editor_not->remove_cap('publish_posts');

			//  noticias - aprobador
			$aprobador_not = get_role('noticias-aprobador');
			$aprobador_not->add_cap('read');
			$aprobador_not->add_cap('publish_posts');
			$aprobador_not->add_cap('edit_published_posts');
			$aprobador_not->add_cap('edit_posts');
			$aprobador_not->add_cap('edit_others_posts');
			$aprobador_not->add_cap('manage_categories');


			$proc_editor = get_role("procedimientos-editor");
			$proc_editor->add_cap('read');
			$proc_editor->add_cap('edit_posts');
			$proc_editor->remove_cap('publish_posts');

			$proc_aprobador = get_role("procedimientos-aprobador");
			$proc_aprobador->add_cap('read');
			$proc_aprobador->add_cap('edit_posts');
			$proc_aprobador->remove_cap('publish_posts');
			$proc_aprobador->remove_cap('edit_published_posts');
			$proc_aprobador->add_cap('edit_posts');
			$proc_aprobador->remove_cap('edit_others_posts');
			$proc_aprobador->remove_cap('manage_categories');



			$proc_publicador= get_role( "procedimientos-publicador" );
			$proc_publicador->add_cap('read');
			$proc_publicador->add_cap('publish_posts');
			$proc_publicador->add_cap('edit_published_posts');
			$proc_publicador->add_cap('edit_posts');
			$proc_publicador->add_cap('edit_others_posts');
			$proc_publicador->add_cap('manage_categories');


			// Deragopyan master
			$der_master = get_role('deragopyan-master');
			$der_master->add_cap("read");
			$der_master->add_cap("edit_posts");
			$der_master->add_cap("publish_posts");
			$der_master->add_cap('edit_others_posts');
			$der_master->add_cap('manage_categories');
			$der_master->add_cap('edit_published_posts');
			$der_master->add_cap('manage_options');

			
		}
		

		public function activate(){}
		public function deactivate(){}

	}

endif;

if(class_exists("Administracion")):
	register_activation_hook(__FILE__, array("Administracion", "activate") );
	register_deactivation_hook(__FILE__, array("Administracion", "deactivate") );
	$wp_plugin_template = new Administracion();
endif;




 ?>