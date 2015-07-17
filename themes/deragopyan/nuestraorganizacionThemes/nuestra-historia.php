<?php 
/**
*
* Template Name: Nuestra Organizacion - Nuestra Historia
*
 *
 * @package Deragopyan
 */
 ?>

<?php require get_template_directory()."/subheader.php"; ?>

<div class="sectionName">
	<h2><div class="cont-center">NUESTRA ORGANIZACION</div></h2>
	<!--busqueda avanzada-->
	<?php include __DIR__ . '/../searchAdvanced.php'; ?>
	<!--busqueda avanzada-->
	<div class="menu-options"></div>
</div>

<div class="background-sections deragopyan-container beneficios nuestra-organizacion">
	<div class="cont-center ">
		<div class="column1 mr" >
			<div class="carta-fundadores">
				<a href="../fundadores/"><p>Carta <br> de los fundadores</p></a>
			</div>
		</div>
		<div class="column2 mr">
			<div class="content-title-triangle">
				<div class="box-title"><?php echo $wp_query->post->post_title; ?></div>
			</div>
			<div class="data-container">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; else: ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				<a href="./linea-de-tiempo">Linea de tiempo</a>
			</div>
		</div>
	</div>
</div>



<?php require get_template_directory()."/pageFooter.php"; ?>
