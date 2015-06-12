<?php if(	isset($_POST["beneficios"])	){ $this->saveBeneficio();	} ?>
<p><?php echo($this->success) ?></p>
<div class="plugin-container beneficios">
	<h1>Crear beneficio</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<fieldset>
			<div class="left">
				Nombre del beneficio
			</div>
			<div class="right">
				<input type="text" name="nombre">
			</div>
		</fieldset>
		<fieldset>
			<div class="left">
				Logo
			</div>
			<div class="right">
				<input type="file" name="logo">
			</div>
		</fieldset>
		<fieldset>
			<div class="left">
				Foto artistica
			</div>
			<div class="right">
				<input type="file" name="foto">
			</div>
		</fieldset>
		<fieldset>
			<div class="left">Descripcion basica</div>
			<div class="right">
				<textarea name="descripcion_basica" id="" cols="30" rows="10"></textarea>
			</div>
		</fieldset>
		<fieldset>
			<div class="left">Descripcion detallada</div>
			<div class="right">
				<textarea name="descripcion_detallada" id="" cols="30" rows="10"></textarea>
			</div>
		</fieldset>
		<fieldset>
			<div class="left">Mapa detalle</div>
			<div class="right">
				<input type="text" id="mapa_beneficio">
				<select name="mapa_beneficio" id="results-google-maps" ></select>
			</div>
			<div class="sede-seleccion">
				<label for="sede">Utilizar sede</label>
				<input type="checkbox" name="sede-checkbox" id="sede-checkbox">
				<select name="sede-seleccion-option" disabled id="sede-seleccion-option">
					<?php sedes_deragopyan_options_fetch(); ?>
				</select>
			</div>
			<div id="map_canvas" style="width:50%; height:500px"></div>

		</fieldset>
		<fieldset>
			<div class="left"></div>
			<div class="right">
				<input type="submit" value="Crear">
			</div>
		</fieldset>
		
		<input type="hidden" value="1" name="beneficios">
	</form>
</div>


<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD4Up6VW3d1hL9aC5wk1E2APbW5_P-ZqxM&sensor=false">
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var mapOptions = {
			    zoom: 6,
			    center: new google.maps.LatLng(-38.942317,-64.3240181)
			  };
		Mapa = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
		var timeCount = 0;
		var find = "";
		$('#mapa_beneficio').keyup(function(event) {
			var find = encodeURI($(this).val());
			if (find != "" && find.length > 4) {
					$.get('http://maps.googleapis.com/maps/api/geocode/json?address='+find+',+AR&sensor=false', function(data) {
						console.log(data);
						$('#results-google-maps').empty();
						$('#results-google-maps').append('<option value="" selected>Seleccione alguno de los resultados</option>');
						$.each(data.results, function(index, val) {
							var dataEncode = {lat: val.geometry.location.lat, lgn: val.geometry.location.lng};
							$('#results-google-maps').append('<option value='+JSON.stringify(dataEncode)+'>'+val.formatted_address+'</option>');
						});
						searched = true;
					});
				};
		});
		$('#results-google-maps').change(function(event) {
			if ($(this).val() != "") {
				var map = JSON.parse($(this).val());
				// Maps.setLocation(map.lat, map.lgn);
				// new google.maps.LatLng(map.lat,map.lgn)
				var latlng = new google.maps.LatLng(-38.942317,-64.3240181);
				var marker = new google.maps.Marker({
	                 map: Mapa,
	                 zoom: 10,
	                 position: latlng,
	                 title: 'Hello World!'
	             });
				marker.setMap(Mapa);

			};
		});
		$('#sede-checkbox').change(function(event) {
			if ($(this).prop("checked")) {
				$('#sede-seleccion-option').removeAttr('disabled');
			}else{
				$('#sede-seleccion-option').attr('disabled','');
			}
		});
		
		
		
	});
</script>
