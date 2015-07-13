<?php
/*
Plugin Name: PDF
Description: Plugin necesario para cumplir las funciones de pdf.
Version: 1.0
Author: Ezequiel Romero
Author URI: 
License: GPL2
*/
/*

*/

if(!class_exists('PDF'))
{
	class PDF
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct(){
			add_action( 'wp_ajax_pdf',array($this,"ajax") );
			add_action( 'wp_ajax_nopriv_pdf',array($this,"ajax") );

		} 
		
		public static function html(){
			$html = '<html >
			<head></head>
			<body>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad ipsam distinctio iusto, eaque. Earum nesciunt natus cumque sit adipisci soluta! Perferendis velit et quaerat similique odit consectetur quia quibusdam non.</p>
				<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque dicta possimus dolores distinctio a amet consequatur sint nostrum quam, at tenetur veritatis, et ab sapiente ipsum. Quas, nostrum quaerat facilis!</div>
				<div>Consequuntur sunt molestiae esse ad officiis reprehenderit fugit similique iste, eaque soluta et quod nulla eum vel culpa dolores sequi praesentium qui, repellendus architecto. Voluptatibus cumque suscipit aliquam vitae quisquam.</div>
				<div>Esse autem quidem deserunt possimus, consequatur delectus suscipit perferendis aut ex ab, porro explicabo amet facere numquam ipsa expedita, quis maiores voluptatum sint vitae minus quasi consequuntur aliquid officiis. Ea.</div>
			</body>
			</html>';

			self::factory($html,"example.pdf");
			
		}
		
		public static function random(){
			return substr(md5((string)rand()."randomfile"), 0,20).".pdf";
		}
		public static function factory($html,$name = null){
			require_once(plugin_dir_path(__FILE__)."/config.php");
			$dompdf = new DOMPDF();
			$dompdf->load_html($html);
			$dompdf->set_paper("a4", "portrait");
			$dompdf->render();
			$output = $dompdf->output();
			$dir = self::makePDF($name,$output);
			echo($dir);
		}
		public static function makePDF($name = null,$output){
			if(is_null($name)):
				$name = self::random();
			endif;
			$dir = get_template_directory()."/pdf/".$name;
			$url = get_template_directory_uri()."/pdf/".$name;
			if(file_exists($dir)):
				file_put_contents($dir, $output);
				return $url;
			else:
				$fp = fopen($dir, "w");
				fwrite($fp, $output);
				fclose($fp);
				return $url;
			endif;
			

		}
		public function ajax(){
			switch ($_POST['get']) {
				case 'example':
					 self::html();
					break;
				
				default:
					# code...
					break;
			}
			die();
		}
		public function generate(){

		}
		public static function activate(){}
		public static function deactivate(){} 
	} 
} 

if(class_exists('PDF'))
{
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('PDF', 'activate'));
	register_deactivation_hook(__FILE__, array('PDF', 'deactivate'));

	// instantiate the plugin class
	$wp_plugin_template = new PDF();

}
