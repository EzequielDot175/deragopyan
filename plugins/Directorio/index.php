<?php
/*-------------------------------------------------------------------------

   Plugin Name: Directorio
   Description: Custom
   Version: 1.3.2
   Plugin URI: 
   Author: Ezequiel Romero
   Author URI: 
   

--------------------------------------------------------------------------*/
$upload_dir = wp_upload_dir();

define(DIRECTORIO_PLUGIN_DIR, plugin_dir_path(__FILE__));
define(DIRECTORIO_UPLOADS_IMAGES,$upload_dir["basedir"]."/directorio/");
define(DIRECTORIO_LINK_IMAGES,$upload_dir["baseurl"]."/directorio/");
define(PHPEXCEL_ROOT, plugin_dir_path(__FILE__)."class/");
add_action('admin_menu','setDirectorioDeragopyan');


function setDirectorioDeragopyan(){
	add_menu_page( "Directorio",
	"Directorio",
	"manage_options",
	"directorio-deragopyan",
	"getDirectorioHome",
	plugin_dir_url( __FILE__ ) . 'img/icon.jpg'
	);

	add_submenu_page("directorio-deragopyan",
		"Crear empleado",
		"Crear empleado",
		"manage_options",
		"crear-empleado-deragopyan",
		"setEmpleadoDeagopyan"
		);
	add_submenu_page("directorio-deragopyan",
		"Crear Puesto",
		"Crear Puesto",
		"manage_options",
		"crear-puesto-deragopyan",
		"setPuestoDeagopyan"
		);
	add_submenu_page("directorio-deragopyan",
		"Crear grupo de trabajo",
		"Crear grupo de trabajo",
		"manage_options",
		"crear-grupo-deragopyan",
		"setGrupoDeagopyan"
		);
	add_submenu_page("directorio-deragopyan",
		"Crear gerencia/area",
		"Crear gerencia/area",
		"manage_options",
		"crear-gerencia-deragopyan",
		"setGerenciaDeragopyan"
		);
	add_submenu_page("directorio-deragopyan",
		"Exportar a MailPoet",
		"Exportar a MailPoet",
		"manage_options",
		"export-to-mailpoet",
		"updateMailPoetSuscriptions"
		);
	add_submenu_page(null,
		"Editar perfil",
		"Editar perfil",
		"manage_options",
		"editar-perfil-directorio",
		"editEmployeerDeragopyan"
		);
	add_submenu_page(null,
		"directorio-borrar-perfil",
		"directorio-borrar-perfil",
		"manage_options",
		"directorio-borrar-perfil",
		"deletePerfilDeragopyan"
		);
}
function requireMyPlugin($file){
	$path = plugin_dir_path(__FILE__) . "inc/";
	require_once($path.$file);
}



function addScriptsDirectorio(){
	wp_register_script( "js-directorio-admin", plugins_url( 'js/directorio-deragopyan-admin.js',__FILE__ ) );
	wp_register_script( "js-directorio-user", plugins_url( 'js/directorio-deragopyan-user.js',__FILE__ ) );
	if (is_admin()) :
		wp_enqueue_script("js-directorio-admin");
	elseif(!is_admin()):
		wp_enqueue_script("js-directorio-user");
	endif;
}

function addStylesDirectorio(){
	wp_register_style( "css-directorio-main", plugins_url( 'css/directorio-deragopyan-main.css',__FILE__ ) );
	wp_enqueue_style( "css-directorio-main" );
}


add_action( 'wp_print_scripts', 'addStylesDirectorio' );
add_action( 'wp_print_scripts', 'addScriptsDirectorio' );

require_once DIRECTORIO_PLUGIN_DIR."class/class.search.deragopyan.php";
require_once DIRECTORIO_PLUGIN_DIR."class/class.excel.php";
// Carga de empleados
requireMyPlugin("directorio-manager-deragopyan.php");
requireMyPlugin("directorio-create-deragopyan.php");
requireMyPlugin("directorio-puesto-deragopyan.php");
requireMyPlugin("directorio-grupo-deragopyan.php");
requireMyPlugin("directorio-gerencia-deragopyan.php");
requireMyPlugin("directorio-borrar-deragopyan.php");
requireMyPlugin("directorio-editar-deragopyan.php");
requireMyPlugin("directorio-deragopyan-front-end.php");
requireMyPlugin("directorio-export-to-mailpoet.php");
requireMyPlugin("directorio-export-to-mailpoet.php");


add_action("wp_ajax_details_by_id_directorio", array("details_by_id_directorio") );
add_action("wp_ajax_nopriv_details_by_id_directorio", array("details_by_id_directorio") );




?>