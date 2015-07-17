<?php 
/**
*
* Template Name: Página noticias - búsqueda.
*
 *
 * @package Deragopyan
 */


$x = new Noticias();

 ?>

<?php include 'subheader.php'; ?>
<div class="cont-center">
	<?php $x->searchByContent(); ?>
	<?php $x->searchById(); ?>
	
 	<h2><?php echo($x->error) ?></h2>
</div>

<?php include 'pageFooter.php' ?>
