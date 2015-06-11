<?php require_once(DIRECTORIO_PLUGIN_DIR."class/class.export_mailpoet.php"); ?>
<?php function updateMailPoetSuscriptions(){ 

	$x = new ExportToMailPoet();
	$x->prepare();

	if (isset($_POST["export"])):
		$x->insert();
	endif;
 ?>
 <div class="agrega-areas-deragopyan">
	<form action="" method="post">
		<p>Esta opcion permite exportar a los empleados registrados en el directorio para ser usados en MailPoet</p>
		<button>Exportar (<?php $x->getCount() ?>) no registrados aún</button>
		<input type="hidden" name="export">
	</form>
	<?php 
		if($x->success):
			echo("<p>Directorio exportado exitosamente</p>");
		endif;
	 ?>
 </div>
 


 <?php } ?>
