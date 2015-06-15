<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Deragopyan
 */
// if ( ! is_active_sidebar( 'sidebar-2' ) ) {
// 	return;
// }
$noticias = new Noticias();

define('TEM_PATH', get_template_directory());
define('TEM_URI', get_template_directory_uri());

$imgUri = get_site_url()."/wp-content/themes/deragopyan/img/";
include 'tiempo.php';
$tiempo = new Wheater();
get_header();


 ?>
<header>
   	<div class="bg-main-header">
	    <div class="container">
		<div class="row">
	    <?php get_search_form(); ?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" id="logo"></a>
		</div><!-- /row -->
		</div><!-- /container -->	
	</div>
   
</header>
<!-- <div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</div> --><!-- #secondary -->





<?php 
			$noticias->slideshow();
		 ?>
 

 <nav>
 	<div class="cont-center">
 		<?php wp_nav_menu( array( 'menu' => 'Menu home' ) ); ?>
 	</div>
 	<!-- <ul>
 		<a href=""><li class="acces"></li></a>
 		<a href=""><li class="contacto"></li></a>
 		<a href=""><li class="sitemap"></li></a>
 	</ul>
 	<div class="tiempo">
 		<div class="tMax">T<?php $tiempo->temperatura(); ?>°</div>
 		<div class="humedad">
 			<span>H<?php $tiempo->humedad(); ?>%</span>
 			<img src="<?php echo($imgUri) ?>humedad.png" alt="">
 		</div>
 		<div class="data">
 			<span><?php $tiempo->fecha(); ?></span>
 			<img src="<?php echo($imgUri) ?>calendario.png" alt="">
 		</div>
 	</div> -->
 </nav>
 <div class="submenu-home">
		<div class="cont-center">
			<div class="center-submenu">
				<ul>
			 		<a href=""><li class="mail-bg"></li></a>
			 		<a href=""><li class="world-bg"></li></a>
			 		<a href=""><li class="shutdown-bg"></li></a>
			 	</ul>
			 	<div class="tiempo">
			 		

			 		<span class="humedad">H<?php $tiempo->humedad(); ?>%</span>
			 		<span class="tMax">T<?php $tiempo->temperatura(); ?>°</span>
			 		<span class="wheater-bg"></span>

			 		<span class="calendar-bg"></span>
			 		<span class="date-time"><?php $tiempo->fecha(); ?></span>
					
				</div>
			</div>
	 </div>

 </div>
 <div class="last-notices">
 	<div class="cont-center">
 		<div class="box-notices">
 			<div class="box-notice">
 				<span class="icon-calendar-box"></span>
 				<div class="box-notice-data">
 					<div class="box-title-small">calendario</div>
 					<div class="content-notice">
 						<p class="date-box">28 DE MARZO</p>
 						<p class="short-description">Jornada de Actualización en Diagnóstico por Imágenes</p>
 					</div>
 				</div>
 			</div>
 			<div class="box-notice">
 				<span class="icon-calendar-box proced"></span>
 				<div class="box-notice-data">
 					<div class="content-notice">
 						<div class="box-title-small">documentación</div>
 						<p class="date-box">PROCEDIMIENTOS</p>
	 					<p class="short-description">Nombre de procedimiento ejemplo.</p>
	 					<p class="date-box">MANUALES</p>
	 					<p class="short-description">Nombre de procedimiento ejemplo.</p>
 					</div>
 				</div>
 			</div>
 			<div class="box-notice">
 				<span class="icon-calendar-box proced"></span>
 				<div class="box-notice-data">
 					<div class="content-notice">
 						<div class="box-title-small">aviso importante</div>
 						<p class="date-box"></p>
	 					<p class="short-description">Jornada de Actualización Diagnóstico
							por Imágenes Jornada de Actualización 
							en Diagnóstico por Imágenes Jornada 
							de Actualiza en Diagnóstico por Imágenes</p>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div>
    

<footer class="footer-home">
		<div class="inner">
		<div class="row">
			<div class="grid col-6">
				<div class="minilogo"></div>
			</div>
			<div class="col-6 x-logos">
			<div class="icons"><p>VISITÁ NUESTRO SITIO <a href="http://www.deragopyan.com.ar" target="_blank">WWW.DERAGOPYAN.COM.AR</a></p></div>
			</div>
			</div>
		</div>
	</footer>

<script>
	// $("selec")
</script>
