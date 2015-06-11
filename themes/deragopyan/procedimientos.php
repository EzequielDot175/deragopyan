 <?php
/**
*
* Template Name: Página Procedimientos
*
 *
 * @package Deragopyan
 */


get_header(); ?>
<?php include 'subheader.php'; ?>
<!-- CONTENT -->
<div class="sectionName">
	<h2><div class="cont-center"><?php echo $wp_query->post->post_title; ?></div></h2>
</div>

<div class="procedimientos-content deragopyan-container">
	<div class="center-procedimientos">
		<div class="column1">
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
		<div class="column2">
			<div class="fullwidth box-primary btn-procedimientos"><span class="text-proc">GERENCIA</span> <span class="triangle-up"></span></div>
			<ul class="list-categories">
				<?php foreach(Procedimientos::getMenuLeft() as $k => $v): ?>
				<li class="item-category" id="list-item-<?php echo($v->id) ?>"><span class="text-category"><?php echo($v->nombre) ?></span></li>
				<?php endforeach; ?>
			</ul>

			<div class="fullwidth box-primary btn-procedimientos operaciones-btn"><span class="text-proc">PROCEDIMIENTOS</span> <span class="triangle-down"></span></div>

		</div>
		<div class="column3">
			<h3>ÁREAS</h3>
			<div class="data-categories">
				<!-- <div class="item-box-category">
					ITEM
				</div> -->

				<!-- <div class="data-categories-2"> -->
					<!-- <div class="item-data-box">
						<span class="icon-library"></span>
						<h4 class="title-type-section">PROCEDIMIENTOS (PGS)</h4>
						<div class="content-by-filter">
							<p>PG 22 04 Atención en Resonancia Magnética </p>
							<p>PG 22 04 Atención en Resonancia Magnética </p>
							<p>PG 22 04 Atención en Resonancia Magnética </p>
						</div>
					</div>
					<div class="item-data-box">
						<span class="icon-library"></span>
						<h4 class="title-type-section">MANUALES (IPS)</h4>
						<div class="content-by-filter">
							<p>PG 22 04 Atención en Resonancia Magnética </p>
							<p>PG 22 04 Atención en Resonancia Magnética </p>
							<p>PG 22 04 Atención en Resonancia Magnética </p>
						</div>
					</div>
					<div class="item-data-box">
						<span class="icon-library"></span>
						<h4 class="title-type-section">FORMULARIOS</h4>
						<div class="content-by-filter">
							<p>PG 22 04 Atención en Resonancia Magnética </p>
							<p>PG 22 04 Atención en Resonancia Magnética </p>
							<p>PG 22 04 Atención en Resonancia Magnética </p>
						</div>
					</div> -->
					<!-- <div class="content-text">
							
					</div>	 -->		
				<!-- </div> -->


			</div>
		</div>
	</div>
</div>
























<!-- 
<?php
if (class_exists('procedimientos')):
	$x = new Procedimientos();
	$x->getView();
endif;
 ?> -->

<!-- END CONTENT -->
<?php include 'pageFooter.php' ?>
