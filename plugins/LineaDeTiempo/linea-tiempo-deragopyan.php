<?php
/*
Plugin Name: Linea de tiempo deragopyan
Description: A simple wordpress plugin template
Version: 1.0
Author: Ezequiel Romero
Author URI: 
License: GPL2
*/
/*

*/

if(!class_exists('LineaDeTiempoDeragopyan'))
{
	class LineaDeTiempoDeragopyan
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
			require_once(sprintf("%s/post-types/postlineadetiempo.php", dirname(__FILE__)));
			$Post_Type_Template = new PostLineaDeTiempo();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
			add_action("wp_print_scripts", array($this,"addStylesTimeline"));
			add_action("wp_print_scripts", array($this,"addScriptTimeline"));


		} // END public function __construct

		/**
		 * Activate the plugin
		 */
		public function addStylesTimeline(){
			wp_register_style("linea-tiempo-style", plugins_url( "css/linea-de-tiempo-deragopyan.css",__FILE__ ) );
			wp_enqueue_style("linea-tiempo-style");
		}
		public function addScriptTimeline(){
			wp_register_script("linea-tiempo-script-1", plugins_url( "js/linea-tiempo-deragopyan.js", __FILE__ ) );
			wp_register_script("linea-tiempo-script-2", plugins_url( "js/modernizr.js", __FILE__ ) );
			wp_enqueue_script("linea-tiempo-script-1");
			wp_enqueue_script("linea-tiempo-script-2");
		}
		public static function activate()
		{
			// Do nothing
		} // END public static function activate

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

if(class_exists('LineaDeTiempoDeragopyan'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('LineaDeTiempoDeragopyan', 'activate'));
	register_deactivation_hook(__FILE__, array('LineaDeTiempoDeragopyan', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new LineaDeTiempoDeragopyan();

}
