<?php
/**
*
* Template Name: Página de Beneficios
*
 *
 * @package Deragopyan
 */


get_header(); ?>
<?php include 'subheader.php'; ?>
<!-- CONTENT -->
<div class="sectionName">
	<h2><div class="cont-center"><?php echo $wp_query->post->post_title; ?></div></h2>
	
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


<div class="background-sections deragopyan-container beneficios">
	<div class="cont-center ">

		<div class="column2 mr">
			<div class="data-container">
				<div class="navigator">Beneficios > <span class="inside"></span></div>
				<div class="beneficios-all">
					<?php foreach(Beneficios::getData() as $k => $v): ?>
					<div class="item-beneficio">
						<div class="b-mask-bg" style="background:url(<?php echo(wp_upload_dir()["baseurl"].'/beneficios/'.$v->foto) ?> )"></div>
						<div class="b-mask">
							<div class="b-image" style="background:url(<?php echo(wp_upload_dir()["baseurl"].'/beneficios/'.$v->foto) ?> )"></div>
							<div class="b-logo" style="background:url(<?php echo(wp_upload_dir()["baseurl"].'/beneficios/'.$v->logo) ?> )"></div>
							<div class="b-title"><?php echo($v->nombre) ?></div>
							<div class="b-description"><?php 
							echo($v->descripcion_basica) ?></div>
							<input type="hidden" class="b-id" name="b-id" value="<?php echo($v->id) ?>">
							<input type="hidden" name="b-l_description" class="b-l_description" value="<?php echo($v->descripcion_detallada) ?>">
							<input type="hidden" name="b-map" class="b-map" value='<?php echo($v->mapa_beneficio) ?>'>
							<button class="btn-beneficio">VER BENEFICIO</button>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="beneficio-by-id">
					<div class="b-details">
						<div class="row1">
							<div class="b-image"></div>
							<div class="b-logo"></div>
							<div class="b-title"></div>
							<div class="b-pdescription"></div>
						</div>
						<div class="row2" >	
						</div>
					</div>
					<div class="b-map" id="googleMaps">
					</div>
					<div class="send-data">
						<p>Deseo recibir información sobre este Beneficio</p>
						<input type="text" placeholder="Ingrese su email ..">
						<button>OK</button>
						<a id="download">Descargar beneficio</a>
					</div>
				</div>
			</div>
		</div>
		<div class="column1 panel-buttons sidebarRightFixed">
			<div class="filter-btn" style="margin-top:0;">
				<a id="back">TODOS LOS BENEFICIOS 

					<ul class="subsedes">
						<?php Beneficios::getBeneficiosBySede(true) ?>
					</ul>
				</a>
			</div>	
		</div>
	</div>
</div>

<input type="hidden" id="event">

<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD4Up6VW3d1hL9aC5wk1E2APbW5_P-ZqxM&sensor=false">
</script>

<script>
	jQuery(document).ready(function($) {



		$('.item-beneficio').hover(function() {
			$(this).children('.b-mask-bg').animate({opacity:1},500);
			// console.log($(this).children('.b-mask').children());
			$(this).children('.b-mask').children(".b-description").css('display', 'none');
			$(this).children('.b-mask').children(".btn-beneficio").animate({top: "14px",opacity:1}, 500);
			// b-description
		}, function() {
			$(this).children('.b-mask-bg').animate({opacity:0},500);
			$(this).children('.b-mask').children(".b-description").css('display', 'block');
			$(this).children('.b-mask').children(".btn-beneficio").animate({top: "82px",opacity:0}, 500);
		});


		// $(window).on('mouseenter', '.item-beneficio', function(event) {
		// 	console.log('');
		// 	$(this).children('.b-mask-bg').animate({opacity:1},500);
		// 	$(this).children('.b-mask').children(".b-description").css('display', 'none');
		// 	$(this).children('.b-mask').children(".btn-beneficio").animate({top: "14px",opacity:1}, 500);
		// });
		// $(window).on('mouseleave', '.item-beneficio', function(event) {
		// 	console.log('');
		// 	$(this).children('.b-mask-bg').animate({opacity:0},500);
		// 	$(this).children('.b-mask').children(".b-description").css('display', 'block');
		// 	$(this).children('.b-mask').children(".btn-beneficio").animate({top: "82px",opacity:0}, 500);
		// });


		$(document).on('click','.btn-beneficio',function(event) {
			/* Act on the event */
			var content = $(this).parent();
			var data = {};
				data.logo =  content.children('.b-logo').attr('style');
				data.title = content.children('.b-title').text();
				data.image = content.children('.b-image').attr('style');
				data.description = content.children('.b-description').text();
				data.longDescription = content.children('.b-l_description').val();
				data.map = content.children('.b-map').val();

			var row1 = $('.beneficio-by-id').children('.b-details').children('.row1');
			var row2 = $('.beneficio-by-id').children('.b-details').children('.row2');

				row1.children('.b-image').attr('style',data.image);
				row1.children('.b-logo').attr('style',data.logo);
				row1.children('.b-title').text(data.title)
				row1.children('.b-image').attr('style',data.image);
				row1.children('.b-pdescription').text(data.description);
				row2.empty();
				row2.append('<p>'+data.longDescription+'</p>');

			$('.beneficios-all').hide();
			$('.beneficio-by-id').show();

			var map = data.map.replace(/\\/ig,"");
				map = JSON.parse(map);

			var mapOptions = {
		          center: new google.maps.LatLng(map.lat, map.lgn),
		          zoom: 18,
		          mapTypeId: google.maps.MapTypeId.ROADMAP
		        };
			var Mapa =  new google.maps.Map(document.getElementById("googleMaps"),mapOptions);
				Mapa.setCenter(new google.maps.LatLng(map.lat, map.lgn));
          	var marker = new google.maps.Marker({position:new google.maps.LatLng(map.lat, map.lgn)});
              	marker.setMap(Mapa);

		});
		$('#back').click(function(event) {
			$('.beneficios-all').show();
			$('.beneficio-by-id').hide();

		});
		$('#back').hover(function() {
			$('.subsedes').addClass('visible');
		}, function() {
			setTimeout(function(){
				$('.subsedes').removeClass('visible');
			}, 5000);

		});


		$(document).on('click','li[id^="sede-beneficio-"]',function(event) {
			var value = parseInt($(this).attr('id').replace(/sede-beneficio-/ig, ''));
			var btn = $(this);
			var navigate = btn.text().replace(/\(+[0-9].*\)/ig, '').trim();
			$.post("/wp-admin/admin-ajax.php", {action: 'filterBySede',sede: value}, function(data, textStatus, xhr) {
				var data = jQuery.parseJSON(data);
				// if (data.length) {};
				if (data.length > 0) {
					$('.beneficios-all').empty();
					$.each(data, function(index, val) {
						var replace = [
							{before: "#b-mask-bg", after: TemplateHTML.uploadDir+"beneficios/"+ val.foto},
							{before: "#b-image", after: TemplateHTML.uploadDir+"beneficios/"+val.foto},
							{before: "#b-logo", after: TemplateHTML.uploadDir+"beneficios/"+val.logo},
							{before: "#b-title", after: val.nombre},
							{before: "#b-description", after: val.descripcion_basica},
							{before: "#b-id", after: val.id},
							{before: "#b-l_description", after: val.descripcion_detallada},
							{before: "#b-map", after: val.descripcion_basica},
						];
						$('.beneficios-all').append(TemplateHTML.onTemplate("beneficio",replace));
					});
					$('.item-beneficio').hover(function() {
						$(this).children('.b-mask-bg').animate({opacity:1},500);
						// console.log($(this).children('.b-mask').children());
						$(this).children('.b-mask').children(".b-description").css('display', 'none');
						$(this).children('.b-mask').children(".btn-beneficio").animate({top: "14px",opacity:1}, 500);
						// b-description
					}, function() {
						$(this).children('.b-mask-bg').animate({opacity:0},500);
						$(this).children('.b-mask').children(".b-description").css('display', 'block');
						$(this).children('.b-mask').children(".btn-beneficio").animate({top: "82px",opacity:0}, 500);
					});
				};
				$('.inside').text(navigate);
				$('.navigator').css('display', 'block');
			});
		});

		$('#download').click(function(event) {
			event.preventDefault();
			$.fn.plug("pdf",{get:"example"},function(a){
				console.log(a);
			});

		});
	

	});

</script>

<!-- END CONTENT -->
<?php include 'pageFooter.php' ?>




