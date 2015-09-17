<?php 

	/**
	* 
	*/
	class MoreFunctions 
	{
		private $db;
		
		public function __construct()
		{
			global $wpdb;
			$this->db = $wpdb;
		}

		public function getTeamManager($str = null){
			$posts = get_posts(array("category_name"=>"TeamManager"));
			$query = $this->db->get_results("SELECT team_name FROM `wp_easy_team_manager`",ARRAY_A);
			foreach ($query as $key => $value) {
				print(easy_team_manager_shortcode(array("team_name"=> $value["team_name"])));
			}
		}
	}


 ?>