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
	<!--sidebar-->
	<div class="cont-center">
		<div class="sidebar">
			<div  class="boton-sidebar">
				<img id="mostrar-sidebar" src="http://www.deragopyan.com/wp-content/themes/deragopyan/img/flecha-galerry-bottom.png" alt="">
				<img id="ocultar-sidebar" class="oculta" src="http://www.deragopyan.com/wp-content/themes/deragopyan/img/flecha-galerry-top.png" alt="">
			</div>
			<div class="column1 mr sidebarDesplegable">
				<input type="text" placeholder="Búsqueda avanzada" class="search-input">
				<div class="filter-btn" >
					<span class="numbers number-1">1</span>
					<input type="text" placeholder="FECHA" class="date-input" id="calendar">
				</div>
				<div class="filter-btn" > 
					<span class="numbers number-2">2</span>
					<span class="text">NOMBRE</span>
					<span class="small-arrow-down"></span>
				</div>
				<div class="filter-btn">
					<span class="numbers number-2">3</span>
					<span class="text">CATEGORIA</span>
					<span class="small-arrow-down"></span>
				</div>
				<div class="filter-btn">
					<span class="numbers number-2">4</span>
					<input type="text" placeholder="PALABRA CLAVE" class="date-input">
				</div>
				<div class="submit-search-form">
					<button>FILTRAR</button>
				</div>
			</div>
		</div>
	</div>
	<!--//sidebar-->
	<div class="menu-options">
		
	</div>
</div>


<div class="background-sections deragopyan-container beneficios nuestra-organizacion">
	<div class="cont-center ">

		<div class="column2 mr fundadores">
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
	</div>
</div>
<?php require get_template_directory()."/pageFooter.php"; ?>
