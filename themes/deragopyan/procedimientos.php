 <?php
/**
*
* Template Name: Página Procedimientos
*
 *
 * @package Deragopyan
 */

get_header(); 

?>

<?php include 'subheader.php'; ?>

<!-- CONTENT -->

<div class="sectionName">
	<h2><div class="cont-center"><?php echo $wp_query->post->post_title; ?></div></h2>
	<!--busqueda avanzada-->
	<?php include 'searchAdvanced.php'; ?>
	<!--busqueda avanzada-->
	<div class="menu-options"></div>
</div>

<div class="procedimientos-content deragopyan-container">
	<div class="center-procedimientos">
		
		<div class="column2 sidebarLeftFixed">
			<div class="fullwidth box-primary btn-procedimientos"><span class="text-proc">GERENCIA</span> <span class="triangle-up"></span></div>
			<ul class="list-categories">
				<?php foreach(Procedimientos::getMenuLeft() as $k => $v): ?>
				<li class="item-category" id="list-item-<?php echo($v->id) ?>"><span class="text-category"><?php echo($v->nombre) ?></span></li>
				<?php endforeach; ?>
			</ul>

			<div class="fullwidth box-primary btn-procedimientos operaciones-btn"><span class="text-proc">PROCEDIMIENTOS</span> <span class="triangle-down"></span></div>

		</div>
		<div class="column3 contenedorLeftFixed">
			<h3>ÁREAS</h3>
			<div class="data-categories">
				<!-- <div class="item-box-category">
					ITEM
				</div> -->

				<!-- GERENCIA /MEDICA / ÁREAS -->
				<div style='display:none' class="data-categories-2">
					<div class="item-data-box">
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
					</div>
					<div class="content-text">
					</div>
				</div>
				<!-- GERENCIA /MEDICA / ÁREAS -->

				<!-- RESONANCIA MAGNÉTICA -->
				<div class="procedimientos">
					<div class="procedimientos-subtitulo">
						<h4>NUEVAS TECNOLOGIAS DE ESTUDIOS LLEGAN AL</h4>
						<h4>PG 22 04 en Resonancia Magnética</h4>
					</div>
					<p>ESTUDIOS CON CONTRASTE:</p>
					<p>19) En los casos en que el estudio es solicitado “con contraste”, una vez tomada una cierta cantidad de imágenes, el Profesional Médico de Prestación Asistencial ingresará a la sala del resonador, le explicará al paciente lo que se le inyectará para completar su estudio. Le informará sobre la sustancia suministrada es inocua y que no posee contraindicaciones. Luego de obtener nuevas imágenes, se le indica al paciente que puede continuar con su vida en forma normal y que está permitida la ingestión de bebidas y/o alimentos. Se le recomendará no hacer esfuerzos con el brazo donde se le colocó la vía.</p>
					<p>20) En casos donde al segundo intento no se logre la colocación de la vía endovenosa, el Técnico de Prestación Asistencial le informará al paciente que se convocará a la persona más experimentada en la realización de esta tarea.</p>
					<p>21) Si de todos modos, aun fuera imposible la colocación, el Profesional Médico de Prestación Asistencial decidirá continuar o no con el procedimiento. Deberá contar con el consentimiento del paciente y/o su acompañante en caso de estar presente.</p>
					<p>ENTREGA DE PLACAS SIN INFORME:</p>
					<p>22) Se encuentra autorizada la entrega de placas, cuando:</p>
					<p>- el Profesional Médico Asistencial o el Técnico así lo consideren necesario por la patología que surja del estudio realizado - a pedido del paciente</p>
					<p>- a pedido del médico derivante</p>
					<p>23) Para todos estos casos se deberá cumplir con lo detallado a continuación:</p>
					<p>- NO tratarse de un estudio solicitado por una ART</p>
					<p>- Verificar que el estudio fue enviado al PACS</p>
					<p>- Que las placas estén impresas según protocolo definido</p>
					<p>- Verificar identidad del paciente en las placas</p>
					<p>- Que NO haya pagos pendientes por parte del paciente para ese estudio</p>
					<p>24) Quien realice la entrega de las placas, deberá dejar asentada esta situación en el sistema EGES en el campo Observaciones.</p>
					<p>25) En la tanda de estudios, estará la bolsa del estudio cuyas placas fueron entregadas junto con el talón técnico, el consentimiento firmado por el paciente aclarando que las imágenes ya fueron entregadas.</p>
					<p>ESTUDIOS PARA RECITACION:</p>
					<p>26) Para los estudios que no pudieron completarse en el turno asignado, el Profesional Médico/Técnico de Prestación Asistencial, le informará al paciente que el estudio se completará en otro momento y que se le asignará un nuevo turno por el tiempo de práctica faltante. Para dejar adecuado registro de la situación, seguirá los pasos descriptos en IP 22.04.01 Estudios en Recitación y IP 22.04.02 Atención de pacientes en Servicios Médicos.</p>
					<p>El Profesional Técnico de Prestación Asistencial y/o el Profesional Médico Residente de Prestación Asistencial, serán los únicos autorizados a solicitar la recitación de un paciente dejando registro en el sistema EGES indicando el motivo real, las secuencias o regiones faltantes y la cantidad de minutos requerida, presencia de un profesional específico.</p>
				</div>
				<!-- RESONANCIA MAGNÉTICA -->
				
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
