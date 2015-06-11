<?php
	function sedes_degaropyan_rem_esp(){
		global $wpdb;
		$wpdb->delete( 'wp_sedes_especialidades',array("id" => (int)$_GET["id"]) );
	}

 ?>