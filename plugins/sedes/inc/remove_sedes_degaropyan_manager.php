<?php
	function remove_sedes_degaropyan_manager(){
		
		global $wpdb;
		
		if (isset($_GET)) {
			$id = mysql_real_escape_string((int)$_GET["find"]);
			$sql = "DELETE FROM ".$wpdb->prefix."sedes_degaropyan WHERE id = ".$id;
			$query = $wpdb->query($sql);
			if ($query) {
				echo("<script>window.location.href = 'admin.php?page=sedes_degaropyan_manager'</script>");
			}
		}

	}
?>