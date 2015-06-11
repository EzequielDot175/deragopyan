<?php function deletePerfilDeragopyan(){ ?>

<?php 
	
	$id = (int)$_GET["pid"];
	global $wpdb;
	$file = $wpdb->get_results("SELECT dir_foto FROM wp_directorio WHERE id = ".$id);
	if($file[0]->dir_foto != "default.png"):
		$link  = "../wp-content/uploads/directorio/".$file[0]->dir_foto;
		unlink($link);
	endif;
	$row = $wpdb->delete("wp_directorio", array("id" => $id));
	if ($row == 1) :
	 	?> <script>window.location.href ="?page=directorio-deragopyan"; </script> <?php
	 else:
		?> Este perfil no existe! <script>setTimeout(function(){window.location.href ="?page=directorio-deragopyan"; },2000);</script> <?php
	 endif;
	

 ?>

<?php } ?>