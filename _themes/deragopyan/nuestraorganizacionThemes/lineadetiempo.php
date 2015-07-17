<?php 
/**
*
* Template Name: Nuestra Historia - Linea de tiempo
*
 *
 * @package Deragopyan
 */


?>

<?php include $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/deragopyan/subheader.php"; ?>


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
			<div class="data-container linea-de-tiempo">
				<?php if(class_exists("lineadetiempoderagopyan")): ?>
				<?php $data = PostLineaDeTiempo::getAllYearsOfEvents(); ?>
				
				<section id="cd-timeline" class="cd-container">
					<?php foreach($data as $k => $v): ?>
					<div class="cd-timeline-block year-timeline">
						<span><?php echo($k) ?></span>
					</div>
					
					<?php foreach($v as $kv => $vv): ?>
					<div class="cd-timeline-block">
						<div class="cd-timeline-img cd-picture">
						</div> <!-- cd-timeline-img -->

						<div class="cd-timeline-content">
							<h2><?php echo($vv["titulo"]) ?></h2>
							<p><?php echo(strip_tags($vv["contenido"])) ?></p>
							<a href="#0" class="cd-read-more">Leer Mas</a>
							<span class="cd-date"><?php echo($vv["fecha"]) ?></span>
						</div> <!-- cd-timeline-content -->
					</div> <!-- cd-timeline-block -->
				<?php endforeach; ?>

				<?php endforeach; ?>
					
				</section> <!-- cd-timeline -->
			<?php endif; ?>

			</div>
		</div>
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				<a href="../">VOLVER</a>
			</div>
		</div>
	</div>
</div>



<?php include $_SERVER["DOCUMENT_ROOT"]."/wp-content/themes/deragopyan/pageFooter.php"; ?>