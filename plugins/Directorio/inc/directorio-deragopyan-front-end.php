<?php function frontEntDeragopyanDirectorio(){ 
 $rows = D_empleado::front(); 
 $gerencias = array_keys($rows);
?>

<!-- ---------------------------------------------------------------------------------------------------------------- -->
<!-- <div class="search-directorio">
	<h4>Busqueda avanzada</h4>
	<form action="" id="search_directorio">
		<p>Buscar por ...</p>
		<fieldset>
			<label for="sede">Sede</label>
			<select name="dir_sede" id="">
				<option value="">Seleccionar Sede</option>
				<?php sedes_deragopyan_options_fetch(null,true); ?>
			</select><br>
			<label for="gerencia">Gerencia</label>
			<select name="dir_gerencia_area" id="">
				<option value="">Seleccionar Gerencia</option>
				<?php D_Gerencia::getOptions(null,false,true); ?>
			</select><br>
			<label for="grupo">Grupo de trabajo</label>
			<select name="dir_grupo" id="">
				<option value="">Seleccionar Puesto</option>
				<?php D_Grupos::getOptions(null,false,true); ?>
			</select><br>
			<label for="puesto">Puesto</label>
			<select name="dir_puesto" id="">
				<option value="">Seleccionar Puesto</option>
				<?php D_Puestos::getOptions(null,false,true); ?>
			</select><br>
			<label for="keywords">Keywords</label>
			<input type="text" id="keywords" placeholder="Example: keyword1,keyword2, etc...">
			<br>
			<input type="submit" >
			<button class="reset-query">Reiniciar</button>
	</form>
</div>
<div class="directorio-main-container">
<?php foreach($rows as $kGerencia => $vGerencia): ?>
<ul class="directorio-container">
	<h1><?php echo($kGerencia) ?></h1>
	<div class="directorio-content-row">
	<?php foreach ($vGerencia as $k => $v): ?>
		<li >
			<a href="#" class="directorio-profile-user">
				<div class="apellido"><?php echo($v["dir_apellido"]) ?></div>
				<div class="nombre"><?php echo($v["dir_nombre"]) ?></div>
				<div class="puesto"><?php echo($v["puesto"]) ?></div>
				<input type="hidden" value="<?php echo($v["id"]) ?>" class="dir-get">
			</a>
		</li>
	<?php endforeach; ?>
	</div>
</ul>
<?php endforeach; ?>
</div> -->
<!-- ---------------------------------------------------------------------------------------------------------------- -->


<div class="sectionName">
	<h2><div class="cont-center">Directorio</div></h2>
	<!--busqueda avanzada-->
	<?php include __DIR__ . '/../../../themes/deragopyan/searchAdvanced.php"'; ?>
	<!--busqueda avanzada-->
	<div class="menu-options"></div>
</div>
<div class="background-sections deragopyan-container directorio">
	<div class="cont-center ">
		
		<div class="column2 mr">
			<?php foreach($rows as $kGerencia => $vGerencia): ?>
			<div class="directorio-gerencia">
				<div class="gerencia-title">
					<span><?php echo($kGerencia) ?></span>
				</div>
				<?php foreach ($vGerencia as $k => $v): ?>
				<?php $cn = $k+1; ?>
				<?php $class = ($cn == 1 || $cn%4 == 0 ? "first" : ""); ?>
				<div class="gerencia-personal <?php echo($class) ?>">
					<div class="image" style="background:url(<?php echo(DIRECTORIO_LINK_IMAGES.$v["dir_foto"]) ?>)">
						
					</div>
					<div class="data-personal">
						<div class="subtitle">Puesto</div>
						<p><?php echo($v["puesto"]) ?></p>
						<div class="subtitle">Sede</div>
						<p><?php echo($v["sede"]) ?></p>
					</div>
					<input type="hidden" value="<?php echo($v["id"]) ?>">
				</div>
				<?php endforeach; ?>

			</div>
			<?php endforeach; ?>
			<div class="directorio-detalle">
				<div class="gerencia-title">
					<span id="gerencia-dt">GERENCIA</span>
				</div>
				<div class="detalle-empleado">
					<div class="image-dt" id="image-dt"></div>
					<div class="detalle-dt">
						<div class="col1-dt">
							<div class="subtitle">Puesto</div>
							<p id="puesto-dt"></p>
							<div class="subtitle">Sede</div>
							<p id="sede-dt"></p>
							<div class="subtitle">Gerencia / Área</div>
							<p id="area-dt"></p>
							<div class="subtitle">Grupo de trabajo</div>
							<p id="grupodetrabajo-dt"></p>
							<div class="subtitle">Interno</div>
							<p id="interno-dt"></p>
						</div>
						<div class="col2-dt">
							<div class="subtitle">Celular</div>
							<p id="celular-dt"></p>
							<div class="subtitle">Email</div>
							<p id="email-dt"></p>
							<div class="subtitle">Fecha Nac</div>
							<p id="fecha-dt"></p>
							<div class="subtitle">N Legajo</div>
							<p id="legajo-dt"></p>
						</div>
						<div class="shadow"></div>
					</div>
					<div class="send-mail">
						<p>ENVIAR UN MENSAJE <span class="icon-send"></span></p>
					</div>
					<div class="send-mail-box">
						<span class="icon-send toggle-send"></span>
						<div class="box-form">
							<p>Nombre y apellido</p>
							<input type="text">
							<br>
							<p>Asunto</p>
							<input type="text">
							<br>
							<p>mensaje</p>
							<textarea name="" id="" cols="30" rows="10"></textarea>
							<button>OK</button>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="column1 panel-buttons sidebarRightFixed">
			<div class="filter-btn back">
				TODAS LAS GERENCIAS
			</div>
			<div class="filter-btn">
				NUESTRA SEDE
			</div>
			<div class="filter-btn">
				NUESTRA HISTORIA
			</div>
		</div>
</div>


<script>
	jQuery(document).ready(function($) {
		$('.gerencia-personal').click(function(event) {
			var id = $(this).children('input[type="hidden"]').val();
			var url = "/wp-admin/admin-ajax.php";
			var img = $(this).children('.image').attr('style');
			var param = {
				action: "detailsbyid_dir",
				id : id
			}
			$.post(url, param, function(data) {
				var fmd = $.parseJSON(data);

				console.log(fmd);
				$('#gerencia-dt').text(fmd[0].gerencia);

				$('#puesto-dt').text(fmd[0].puesto);
				$('#sede-dt').text(fmd[0].sede);
				$('#area-dt').text(fmd[0].gerencia);
				$('#grupodetrabajo-dt').text(fmd[0].grupo);
				$('#interno-dt').text(fmd[0].interno);

				$('#celular-dt').text(fmd[0].celular);
				$('#email-dt').text(fmd[0].email);
				$('#fecha-dt').text(fmd[0].nacimiento);
				$('#legajo-dt').text(fmd[0].legajo);

				$('#image-dt').attr('style', img);

				$('.directorio-gerencia').hide();
				$('.directorio-detalle').show();



			});



		});


		$('.send-mail').click(function(event) {
			$(this).toggle("blind",300);
			$(".send-mail-box").toggle("blind",300);
		});
		$('.toggle-send').click(function(event) {
			$(".send-mail").toggle("blind",300);
			$(".send-mail-box").toggle("blind",300);
		});

		$('.back').click(function(event) {
			$('.directorio-gerencia').show();
			$('.directorio-detalle').hide();
		});
	});
</script>



<?php } ?>