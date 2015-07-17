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
			$html = '
				<html>
					<head>
						<style>
							p{
								color: #666;
							}
							
						</style>
					</head>
					<body>
						<div class="b-details">
							<div class="row1" style="width: 300px; float:left; display: block">
								<div style="width: 300px; float:left; display: block">
									<img class="b-image" style="width: 150px; border-radius: 100%; margin-left:80px" src="http://www.deragopyan.com/wp-content/uploads/beneficios/24296de1807c8d64c7a4e9eac7afc687.jpg">
								</div>
								<div style="width:300px; float:left; display: block">
									<img class="b-logo" style="width: 150px; margin-left:80px; margin-top: 10px; margin-bottom: 10px" src="http://www.deragopyan.com/wp-content/uploads/beneficios/1f94e78459c5cf76c861b6a1238fc651.png">
								</div>
								<div class="b-title" style="color:#666; text-transform:uppercase; text-align:center; font-size: 25px; margin: 10px 0;" >20% OFF</div>
								<div class="b-pdescription" style="color: #666; text-align: justify" >Lorem ipsum dolor sit amet, consectet dolor sit amet, consectet.</div>
							</div>
							<div class="row2" style="width: 300px; float:left; display: block; text-align: justify" >
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
							</div>
						</div>
						<div class="b-map" id="googleMaps" style="width: 300px; heigth: 300px;">
						</div>
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
