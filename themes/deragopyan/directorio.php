<?php 
/**
*
* Template Name: Página Directorio
*
 *
 * @package Deragopyan
 */


 ?>

 <?php include 'subheader.php'; ?>
	

<link href='http://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>

<div class="directorio">
	<?php 
	//wp-content\plugins\Directorio\inc\directorio-deragopyan-front-end.php
	if (function_exists("frontEntDeragopyanDirectorio")) :
		frontEntDeragopyanDirectorio();
	endif; 
	?>
</div>


<?php include 'pageFooter.php' ?>
