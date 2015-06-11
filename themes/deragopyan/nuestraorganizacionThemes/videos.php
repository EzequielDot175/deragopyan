<?php 
/**
*
* Template Name: Nuestra Organizacion - videos
*
 *
 * @package Deragopyan
 */



 ?>



<?php require get_template_directory()."/subheader.php"; ?>
<div class="sectionName">
	<h2><div class="cont-center">Nuestra organización</div></h2>
	<div class="menu-options">
		
	</div>
</div>

<div class="background-sections deragopyan-container nuestra-organizacion">
	<div class="cont-center ">
		<div class="column1 mr" >
			<input type="text" placeholder="Búsqueda avanzada" class="search-input">
			<div class="filter-btn">
				<span class="numbers number-1">1</span>
				<span class="text">FECHA</span>
				<span class="small-arrow-down"></span>
			</div>
			<div class="filter-btn">
				<span class="numbers number-2">2</span>
				<span class="text">CATEGORIA</span>
				<span class="small-arrow-down"></span>
			</div>
			<div class="filter-btn filter-search">
				<span class="numbers number-2">3</span>
				<span class="text">PALABRA CLAVE</span>
				<input type="text" class="search-input-filter">
			</div>
			<div class="submit-search-form">
				<button>FILTRAR</button>
			</div>
		</div>
		<div class="column2 mr">
			<div class="content-title-triangle">
				<div class="box-title"><?php echo $wp_query->post->post_title; ?></div>
			</div>
			<div class="data-container general-content">

				 <?php
				    // TO SHOW THE PAGE CONTENTS
				    while ( have_posts() ) : the_post(); ?> <!--Because the_content() works only inside a WP Loop -->
				        <div class="entry-content-page">
				            <?php the_content(); ?> <!-- Page Content -->
				        </div><!-- .entry-content-page -->

				    <?php
				    endwhile; //resetting the page loop
				    wp_reset_query(); ?>
			</div>
		</div>
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				<a href="/nuestra-organizacion/">MISIÓN, VISIÓN Y VALORES</a>
			</div>
			<div class="filter-btn">
				<a href="/nuestra-organizacion/sedes">NUESTRA SEDE</a>
			</div>
			<div class="filter-btn">
				<a href="/nuestra-organizacion/nuestra-historia">NUESTRA HISTORIA</a>
			</div>
			<div class="filter-btn">
				<a href="/nuestra-organizacion/organigrama">ORGANIGRAMA</a>
			</div>
		</div>


	</div>
</div>


<?php require get_template_directory()."/pageFooter.php"; ?>
