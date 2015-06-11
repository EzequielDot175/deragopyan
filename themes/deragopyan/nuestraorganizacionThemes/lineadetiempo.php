<?php 
/**
*
* Template Name: Nuestra Historia - Linea de tiempo
*
 *
 * @package Deragopyan
 */


?>
<?php require get_template_directory()."/subheader.php"; ?>
<?php 
	$data = PostLineaDeTiempo::getAllYearsOfEvents();
	$years = array_keys($data);
 ?>

<div class="sectionName">
	<h2><div class="cont-center">NUESTRA ORGANIZACIÓN</div></h2>
	<div class="menu-options">
		
	</div>
</div>
<div class="background-sections deragopyan-container beneficios nuestra-organizacion">
	<div class="cont-center ">
		<div class="column1 mr" >
			<div class="years-of-line">
				<?php foreach($years as $k => $v): ?>
					<div class="year">
						<a href="#<?php echo($v); ?>"><?php echo($v); ?></a>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="column2 mr">
			<div class="content-title-triangle">
				<div class="box-title"><?php echo $wp_query->post->post_title; ?></div>
			</div>
			<div class="data-container linea-de-tiempo">
				<?php if(class_exists("lineadetiempoderagopyan")): ?>
				
				<section id="cd-timeline" class="cd-container">
					<?php foreach($data as $k => $v): ?>
					<div class="cd-timeline-block year-timeline">
						<span id="<?php echo($k) ?>"><?php echo($k) ?></span>
					</div>
					
					<?php foreach($v as $kv => $vv): ?>
					<div class="cd-timeline-block">
						<div class="cd-timeline-img cd-picture">
						</div> <!-- cd-timeline-img -->

						<div class="cd-timeline-content">
							<h2><?php echo($vv["titulo"]) ?></h2>
							<p><?php echo(strip_tags($vv["contenido"])) ?></p>
							<!-- <a href="#0" class="cd-read-more">Leer Mas</a> -->
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