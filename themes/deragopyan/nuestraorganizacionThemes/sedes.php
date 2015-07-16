<?php 
/**
*
* Template Name: Nuestra Organizacion - Sedes
*
 *
 * @package Deragopyan
 */
 ?>

<?php require get_template_directory()."/subheader.php"; ?>

<div class="sectionName ">
	<h2><div class="cont-center">Nuestra organización</div></h2>
	<!--busqueda avanzada-->
	<?php include __DIR__ . '/../searchAdvanced.php'; ?>
	<!--busqueda avanzada-->
	<div class="menu-options"></div>
</div>

<div class="background-sections deragopyan-container nuestra-organizacion">
	<div class="cont-center ">
		<div class="column2 mr full">
			<div class="content-title-triangle">
				<div class="box-title"><?php echo $wp_query->post->post_title; ?></div>
			</div>
			<div class="data-container">
					<div class="sede-selection">
					
						<?php $i = 1;foreach(getDataSedes() as $k => $v): ?>
						
						<?php if($i == 3):  ?>
						<div class="sede-item-selection last">
							<div class="item-sede-image default-image" style="background:url(<?php echo(IMG_SEDES.$v->image); ?>);">
							</div>
							<div class="item-sede-title">
								<h4><?php echo "Sede ".$v->name; ?></h4>
							</div>
						</div>
						<?php $i = 1 ;else: $i++;?>

						<div class="sede-item-selection">
							<div class="item-sede-image default-image" style="background:url(<?php echo(IMG_SEDES.$v->image); ?>);">
							</div>
							<div class="item-sede-title">
								<h4><?php echo "Sede ".$v->name; ?></h4>
							</div>
						</div>
						<?php  endif; ?>

						<!-- <div class="sede-item-selection">
							<div class="item-sede-image nodefault-image" style="background:url(<?php echo IMG."/example-full.png"; ?>);">
							</div>
							<div class="item-sede-title">
								<h4>Sede Belgrano Deragopyan</h4>
							</div>
						</div> -->
						<?php endforeach; ?>
					</div>
			</div>
		</div>
		<div class="column1 panel-buttons sidebarRightFixed">
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
