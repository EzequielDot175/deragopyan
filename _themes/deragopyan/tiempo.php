<?php 

	/**
	* Class dependiente de Yahoo Wheater Plugin
	*/
	class Wheater
	{
		private $dataWidged;
		private $connect;
		private $woeid;
		private $typeTemperature;

		private $datos;

		function __construct()
		{
			global $wpdb;
			$this->connect = $wpdb; 
			$this->getDataOptionsWidged();
			$this->getDataWidgetYahoo();
		}

		private function getDataOptionsWidged(){
			$row = $this->connect->get_results("SELECT option_value FROM `wp_options` WHERE `option_name` LIKE 'widget_yahoo-weather-forecast' LIMIT 1");
			if (count($row) > 0) {
				$unserialize =  unserialize($row[0]->option_value);
				foreach ($unserialize as $key => $value) {
					if (is_numeric($key)) {
						$this->woeid = $this->clearData($value["woeid"]);
						$this->typeTemperature = $this->clearData($value["temperature"]);
					}
				}
			}
		}
		private function getDataWidgetYahoo(){
			if (function_exists("yahoo_weather_simplepie")) {
				$this->datos = yahoo_weather_simplepie($this->woeid, $this->typeTemperature, false);
			}
		}
		private function clearData($data){
			if (!empty($data) && !is_null($data)) {
				return $data;
			}
		}
		public function Temperatura(){
			print($this->datos["temperatura"]);
		}
		public function Humedad(){
			print($this->datos["humedad"]);
		}
		public function Fecha(){
			print($this->datos["fecha"]);
		}
		public function Unidad(){
			print($this->datos["unidadTemp"]);
		}
	}



 ?>