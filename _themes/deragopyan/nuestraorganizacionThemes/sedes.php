<?php 
/**
*
* Template Name: Nuestra Organizacion - Sedes
*
 *
 * @package Deragopyan
 */


	require_once(TEM_PATH."/subheader.php");
 ?>

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
		<div class="column1 panel-buttons">
			<div class="filter-btn">
				Otro menu
			</div>
			<div class="filter-btn">
				Otro menu
			</div>
			<div class="filter-btn">
				Otro menu
			</div>
		</div>


	</div>
</div>


<?php require TEM_PATH."/footer.php"; ?>
