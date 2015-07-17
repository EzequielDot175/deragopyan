<?php
/**
*
* Template Name: Página noticias
*
 *
 * @package Deragopyan
 */

$noticias = new Noticias();





get_header(); ?>
<?php include 'subheader.php'; ?>

<div class="sectionName">
	<h2><div class="cont-center"><?php echo $wp_query->post->post_title; ?></div></h2>
</div>

<div class="slideNoticias" >
	<?php $noticias->slideshow(); ?>
	 
</div>

<div class="background-sections deragopyan-container beneficios">
	<div class="cont-center ">
		<div class="column1 mr" >
			<input type="text" placeholder="Búsqueda avanzada" class="search-input">
			<div class="filter-btn">
				<span class="numbers number-1">1</span>
				<input type="text" placeholder="FECHA" class="date-input" id="calendar">
			</div>
			<div class="filter-btn">
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
		<div class="column2 mr">
			<div class="data-container">
				
			</div>
		</div>
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				MISIÓN, VISIÓN Y VALORES
			</div>
			<div class="filter-btn">
				NUESTRA SEDE
			</div>
			<div class="filter-btn">
				NUESTRA HISTORIA

			</div>
		</div>
	</div>
</div>


<?php include 'pageFooter.php' ?>


<script>
	jQuery(document).ready(function($) {
		$('#buscar-noticias').submit(function(event) {
			event.preventDefault();
			var searchVal = $('#search-val').val();
			var parts = searchVal.split(/[\s,]+/);
			var get = "";
			for (var i = 0; i < parts.length; i++) {
				if (i == 0) {
					get += parts[i];
				}else{
					get += "+"+parts[i];
				}
			};
			window.location.href = "./buscar-noticias/?search="+get;
		});

	$(document).foundation();


	});

</script>