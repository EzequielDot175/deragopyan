<?php
/**
*
* Template Name: Noticias template
*
 *
 * @package Deragopyan
 */

$noticias = new Noticias();





get_header(); ?>
<?php require_once('subheader.php'); ?>

<div class="sectionName">
	<h2><div class="cont-center"><?php echo $wp_query->post->post_title; ?></div></h2>
</div>

<?php 
	$noticias->slideshow();
 ?>

<div class="background-sections deragopyan-container beneficios noticias">
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
			<div class="content-1">
				<div class="carousel-principal">
					<!-- item -->
					<div class="noticia-item">
						<div class="img example-1"></div>
						<div class="content-data">
							<h3>CATEGORÍA</h3>
							<p class="date-time">MAR, 23 DE AGOSTO</p>
							<h2>NUEVAS TECNOLOGIAS DE ESTUDIOS LLEGAN</h2>
							<div class="descriptivo">
							<p class="author">Nombre, Autor</p>
							<p class="content">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem...</p>
							</div>
						</div>
					</div>
					<!-- item -->

					<!-- item -->
					<div class="noticia-item">
						<div class="img example-2"></div>
						<div class="content-data">
							<h3>CATEGORÍA</h3>
							<p class="date-time">MAR, 23 DE AGOSTO</p>
							<h2>NUEVAS TECNOLOGIAS DE ESTUDIOS LLEGAN</h2>
							<div class="descriptivo">
							<p class="author">Nombre, Autor</p>
							<p class="content">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem...</p>
							</div>
						</div>
					</div>
					<!-- item -->

					<!-- item -->
					<div class="noticia-item">
						<div class="img example-3"></div>
						<div class="content-data">
							<h3>CATEGORÍA</h3>
							<p class="date-time">MAR, 23 DE AGOSTO</p>
							<h2>NUEVAS TECNOLOGIAS DE ESTUDIOS LLEGAN</h2>
							<div class="descriptivo">
							<p class="author">Nombre, Autor</p>
							<p class="content">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem...</p>
							</div>
						</div>
					</div>
					<!-- item -->
				</div>
			</div>
			<div class="content-2">
				<div class="thumbs-level-1">
					
					<!--  -->
					<div class="row-columns">
						<div class="thumb-item">
							<div class="bg-img"></div>
							<div class="cols-right">
								<span class="categoria">CATEGORÍA</span>
								<span class="date-time">MAR, 23 DE AGOSTO</span>
								<span class="title-white">
									TECNOLOGIAS DE ESTUDIOS LLEGAN
								</span>
								<span class="description">Lorem Ipsum es simplemente el texto de relleno de las imprent...</span>
							</div>
						</div>
						<div class="thumb-item fr">
							<div class="bg-img"></div>
							<div class="cols-right">
								<span class="categoria">CATEGORÍA</span>
								<span class="date-time">MAR, 23 DE AGOSTO</span>
								<span class="title-white">
									TECNOLOGIAS DE ESTUDIOS LLEGAN
								</span>
								<span class="description">Lorem Ipsum es simplemente el texto de relleno de las imprent...</span>
							</div>
						</div>
					</div>
					<!--  -->
					<!--  -->
					<div class="row-columns">
						<div class="thumb-item">
							<div class="bg-img"></div>
							<div class="cols-right">
								<span class="categoria">CATEGORÍA</span>
								<span class="date-time">MAR, 23 DE AGOSTO</span>
								<span class="title-white">
									TECNOLOGIAS DE ESTUDIOS LLEGAN
								</span>
								<span class="description">Lorem Ipsum es simplemente el texto de relleno de las imprent...</span>
							</div>
						</div>
						<div class="thumb-item fr">
							<div class="bg-img"></div>
							<div class="cols-right">
								<span class="categoria">CATEGORÍA</span>
								<span class="date-time">MAR, 23 DE AGOSTO</span>
								<span class="title-white">
									TECNOLOGIAS DE ESTUDIOS LLEGAN
								</span>
								<span class="description">Lorem Ipsum es simplemente el texto de relleno de las imprent...</span>
							</div>
						</div>
					</div>
					<!--  -->
					
				</div>
			</div>

			<div class="content-3">
				<!-- Box content 3 -->
				<div class="row-box">
					<div class="item-box frt">
						<span class="category">
							CATEGORÍA
						</span>
						<h4>
							TECNOLOGIAS DE LOREM ESTUDIOS DE LOS DIAS NUEVAS TECNOLOGIAS 
						</h4>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas</p>
					</div>
					<div class="item-box ">
						<span class="category">
							CATEGORÍA
						</span>
						<h4>
							TECNOLOGIAS DE LOREM ESTUDIOS DE LOS DIAS NUEVAS TECNOLOGIAS 
						</h4>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas</p>
					</div>
					<div class="item-box ">
						<span class="category">
							CATEGORÍA
						</span>
						<h4>
							TECNOLOGIAS DE LOREM ESTUDIOS DE LOS DIAS NUEVAS TECNOLOGIAS 
						</h4>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas</p>
					</div>
				</div>

				<div class="row-box">
					<div class="item-box frt">
						<span class="category">
							CATEGORÍA
						</span>
						<h4>
							TECNOLOGIAS DE LOREM ESTUDIOS DE LOS DIAS NUEVAS TECNOLOGIAS 
						</h4>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas</p>
					</div>
					<div class="item-box ">
						<span class="category">
							CATEGORÍA
						</span>
						<h4>
							TECNOLOGIAS DE LOREM ESTUDIOS DE LOS DIAS NUEVAS TECNOLOGIAS 
						</h4>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas</p>
					</div>
					<div class="item-box ">
						<span class="category">
							CATEGORÍA
						</span>
						<h4>
							TECNOLOGIAS DE LOREM ESTUDIOS DE LOS DIAS NUEVAS TECNOLOGIAS 
						</h4>
						<p>Lorem Ipsum es simplemente el texto de relleno de las imprentas</p>
					</div>
				</div>
				<!-- Box content 3 -->
			</div>
		</div>
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				CATEGORÍA 1
			</div>
			<div class="filter-btn">
				CATEGORÍA 2
			</div>
			<div class="filter-btn">
				CATEGORÍA 3
			</div>
		</div>
	</div>
</div>


<?php require_once('pageFooter.php'); ?>


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