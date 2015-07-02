<?php 

	

require plugin_dir_path(__FILE__ ).'PHPExcel/autoloader.php';
class Reader extends PHPExcel_IOFactory
{
	private static $data;
	
	function __construct(){}

	public static function getX($letter){
		$upperArr = range('A', 'Z') ;
		$LowerArr = range('a', 'z') ;
		if(ctype_upper($letter)){
		    return (array_search($letter, $upperArr) + 1); 
		}else{
		    return (array_search($letter, $LowerArr) + 1); 
		}
	}
	public static function getAlpha(){

	}
	public static function upload($file){
		$dir = plugin_dir_path(__FILE__ )."tempExcel/";
		$dirurl = plugin_dir_url(__FILE__)."tempExcel/";
		
		$tmp = $file["file"]["tmp_name"];
		$dirName = $dir.self::randomName();
		$upload = move_uploaded_file($tmp, $dirName);
		if($upload):
			print_r(self::getData($dirName));
		endif;
		// var_dump($dirurl);
		// endif;

	}
	private static function randomName(){
			$rand = (string)rand(5000, 10000);
			$name = md5($rand);
			return $name.".xlsx";
		}
	public static function getData($file){
		try {
				error_reporting(E_ALL);
		ini_set('display_errors', 1);
			// var_dump(PHPExcel_IOFactory::createReaderForFile($file));
			$objReader = self::createReaderForFile($file);
			$objReader->setLoadSheetsOnly(0);
			$objReader->setReadDataOnly(true);
			$objPHPExcel = $objReader->load($file);
			$highestColumm = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();
			$highestRow = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
			
			$i = 0;
			foreach ($objPHPExcel->setActiveSheetIndex(0)->getRowIterator() as $row) {
			    $cellIterator = $row->getCellIterator();
			    $cellIterator->setIterateOnlyExistingCells(false);
			    foreach ($cellIterator as $cell) {
			        if (!is_null($cell)) {
			            $value = $cell->getCalculatedValue();
			            self::$data[$i][] = $value;
			        }
			    }
			    $i++;
			}
			foreach(self::$data as $k => $v):
				$count = count($v);
				$emptyrows = 0;
				for ($i=0; $i < $count; $i++) { 
					if(empty($v[$i])):
						$emptyrows++;
					endif;
				}
				if($emptyrows == $count || $emptyrows == $count-1):
					unset(self::$data[$k]);
				endif;
			endforeach;
			return self::$data;

		} catch(Exception $e) {
		    die('Error loading file "'.pathinfo($file,PATHINFO_BASENAME).'": '.$e->getMessage());
		}
	}
}


add_action( 'wp_ajax_exceldirectorio', 'exceldirectorio' );
	function exceldirectorio(){
		// print_r($_FILES);
		// print_r($_POST);
		// var_dump();
		Reader::upload($_FILES);
		// echo "string";
		die();
	}



 ?>