<?php 

	/**
	* 
	*/
	class ExportToMailPoet
	{
        private $table = "wp_wysija_user";
        private $list_table = "wp_wysija_user_list";
        private $count ;
        private $newSuscriptions;
        private $inserted = "";
        public $success = false;
		function __construct()
		{
			
		}

		private function generateKeyuser($email){
       		return md5( AUTH_KEY . $email . time() );
    	}

    	private function getDirectorio(){
    		global $wpdb;
    		$rows = $wpdb->get_results("SELECT dir_mail,dir_apellido,dir_nombre FROM wp_directorio");
    		return $rows;
    	}
    	private function getSuscriptores(){
    		global $wpdb;
    		$rows = $wpdb->get_results("SELECT email FROM wp_wysija_user");
            $values = array();
            foreach($rows as $k => $v):
                $values[] = $v->email;
            endforeach;
    		return $values;
    	}
        private function insertOnList($id){
            global $wpdb;
            $option_list = array(
                "list_id" => 4,
                "user_id" => $id,
                "sub_date" => time(),
                "unsub_date" => 0);
            $wpdb->insert($this->list_table, $option_list);
        }
    	public function prepare(){
    		$suscriptos = $this->getSuscriptores();
            $directorio = $this->getDirectorio();
            $newSuscriptores = array();
            $i = 0;
            foreach($directorio as $k => $v):
                if(!in_array($v->dir_mail,$suscriptos)):
                    $newSuscriptores[$i]["email"] =  $v->dir_mail;
                    $newSuscriptores[$i]["lastname"] =  $v->dir_apellido;
                    $newSuscriptores[$i]["firstname"] =  $v->dir_nombre;
                    $newSuscriptores[$i]["keyuser"] =  $this->generateKeyuser($v->dir_mail);
                    $i++;
                endif;
            endforeach;
            $this->count = count($newSuscriptores);
            $this->newSuscriptions = $newSuscriptores;
    	}

        public function insert(){
            global $wpdb;
            foreach ($this->newSuscriptions as $k => $v):
                $wpdb->insert($this->table, $v);
                $this->insertOnList($wpdb->insert_id);
            endforeach;
            $this->count = 0;
            $this->success = true;
        }
        
        public function getCount(){
            print($this->count);
        }
	}

 ?>