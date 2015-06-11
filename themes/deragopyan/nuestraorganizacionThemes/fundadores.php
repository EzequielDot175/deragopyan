<?php 
/**
*
* Template Name: Nuestra Organizacion - Fundacion
*
 *
 * @package Deragopyan
 */



 ?>

<?php require get_template_directory()."/subheader.php"; ?>
<div class="sectionName">
	<h2><div class="cont-center">NUESTRA ORGANIZACIÓN</div></h2>
	<div class="menu-options">
		
	</div>
</div>


<div class="background-sections deragopyan-container beneficios nuestra-organizacion">
	<div class="cont-center ">
		<div class="column1 mr" >
			
		</div>
		<div class="column2 mr">
			<div class="content-title-triangle">
				<div class="box-title"><?php echo $wp_query->post->post_title; ?></div>
			</div>
			<div class="data-container general-content">
				
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
				the_content();
				endwhile; else: ?>
				<?php endif; ?>
			</div>
		</div>
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				<a href="../">MISIÓN, VISIÓN Y VALORES</a>
			</div>
			<div class="filter-btn">
				<a href="./sedes">NUESTRA SEDE</a>
			</div>
			<div class="filter-btn">
				<a href="./nuestra-historia">NUESTRA HISTORIA</a>
			</div>
			<div class="filter-btn">
				<a href="./organigrama">ORGANIGRAMA</a>
			</div>
			<div class="filter-btn">
				<a href="../">VOLVER</a>
			</div>
		</div>
	</div>
</div>
<?php require get_template_directory()."/pageFooter.php"; ?>
