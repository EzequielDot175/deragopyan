<?php $v = $this->getCurrent($_GET["id"]); ?>
<?php if(	isset($_POST["beneficios-update"])	)	{ $this->update(); } ?>
<div class="plugin-container beneficios">
	<?php echo($this->success); ?>
	<h1>Editar Beneficio</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<fieldset>
			<div class="left">
				Nombre del beneficio
			</div>
			<div class="right">
				<input type="text" name="nombre" value="<?php echo($v[0]->nombre) ?>">
			</div>
		</fieldset>
		<fieldset>
			<div class="left">
				Logo
			</div>
			<div class="right">
				<div><img src="<?php $this->imgLink($v[0]->logo) ?>" height="100" width="100" alt=""></div>
				<input type="file" name="logo">
			</div>
		</fieldset>
		<fieldset>
			<div class="left">
				Foto artistica
			</div>
			<div class="right">
				<div><img src="<?php $this->imgLink($v[0]->foto) ?>" height="100" width="100" alt=""></div>
				<input type="file" name="foto">
			</div>
		</fieldset>
		<fieldset>
			<div class="left">Descripcion basica</div>
			<div class="right">
				<textarea name="descripcion_basica" id="" cols="30" rows="10"><?php echo($v[0]->descripcion_basica) ?></textarea>
			</div>
		</fieldset>
		<fieldset>
			<div class="left">Descripcion detallada</div>
			<div class="right">
				<textarea name="descripcion_detallada" id="" cols="30" rows="10"><?php echo($v[0]->descripcion_detallada) ?></textarea>
			</div>
		</fieldset>
		
		<fieldset>
			<div class="left">Mapa detalle</div>
			<input type="text" value="" id="nombre_mapa_actual" disabled>
			<div class="right">
				<input type="text" id="mapa_beneficio" placeholder="Buscar">
				<select name="mapa_beneficio" id="results-google-maps" ></select>
			</div>
			<div id="map_canvas" style="width:50%; height:500px"></div>

		</fieldset>
		<fieldset>
			<div class="left"></div>
			<div class="right">
				<input type="submit" value="Guardar">
			</div>
		</fieldset>
		<input type="hidden" value="<?php echo((int)$_GET["id"]) ?>" name="bfi">
		<input type="hidden" value="1" name="beneficios-update">
	</form>
</div>
<input type="hidden" id="currentMap" value='<?php echo($v[0]->mapa_beneficio) ?>'>

<script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD4Up6VW3d1hL9aC5wk1E2APbW5_P-ZqxM&sensor=false">
</script>
<script type="text/javascript">
	jQuery(document).ready(function($) {

		var LatLng = JSON.parse($('#currentMap').val().replace(/\\/ig, ''));

		console.log(LatLng);
		var mapOptions = {
	          center: new google.maps.LatLng(LatLng.lat, LatLng.lgn),
	          zoom: 14,
	          mapTypeId: google.maps.MapTypeId.ROADMAP
	        };
			Mapa = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);
		var marker = new google.maps.Marker({position:new google.maps.LatLng(LatLng.lat, LatLng.lgn)});
            marker.setMap(Mapa);

        $.get('http://maps.googleapis.com/maps/api/geocode/json?latlng=-34.3220787,-58.7814407&sensor=false', function(data) {
        	$('#nombre_mapa_actual').val(data.results[0].formatted_address);
        });

        $('#mapa_beneficio').keyup(function(event) {
			var find = encodeURI($(this).val());
			if (find != "" && find.length > 4) {
					$.get('http://maps.googleapis.com/maps/api/geocode/json?address='+find+',+AR&sensor=false', function(data) {
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
		$('#results-google-maps').on('change', function(event) {
			event.preventDefault();
			
			var latlng = JSON.parse($(this).val());
			var marker = new google.maps.Marker({position:new google.maps.LatLng(latlng.lat, latlng.lgn)});


			Mapa.setCenter(new google.maps.LatLng(latlng.lat, latlng.lgn));
			marker.setMap(Mapa);
			console.log(marker);
		});
		
	});
</script>