<?php function sedes_degaropyan_edit(){ ?>
<?php 
	global $wpdb;
  $dir = wp_upload_dir();
	$dir = $dir["baseurl"]."/sedes/";

	
  if (isset($_POST["sedes_deragopyan_submit"]) && $_POST["sedes_deragopyan_submit"] == 1) {
      $id = htmlentities($_POST["post_value"]); 
      $nombre_sede = htmlentities($_POST["nombre_sede"]);
      $maps =  $_POST["google_maps_ubication"];
      $medios = serialize($_POST["MediosDeContacto"]);
      $horarios = $_POST["horarios"];
      $sql = "UPDATE wp_sedes_degaropyan 
                SET 
                  name = '".$nombre_sede."',
                  maps = '".$maps."' ,
                  mediosdecontacto =  '".$medios."',
                  horarios = '".$horarios."' ";

      if (!empty($_FILES["image_sede"]["name"])) {
          $files = $_FILES["image_sede"];
          $dir = wp_upload_dir();
          $sql .= ", image = '".$files["name"]."'";
          move_uploaded_file($files["tmp_name"], $dir["basedir"]."/sedes/".$files["name"]);
      }
      $sql .= " WHERE id=".$id;
      $query = $wpdb->query($sql);
      echo("<script>window.location.href = 'admin.php?page=sedes_degaropyan_manager'</script>");
  }
  if (isset($_GET["edit_sede"])) {
    $id_sede = (int)$_GET["edit_sede"];
    $row = $wpdb->get_row("SELECT * FROM ".$wpdb->prefix."sedes_degaropyan WHERE id = ".$id_sede);
    ($row->mediosdecontacto != "" ? $medios = unserialize($row->mediosdecontacto) : $medios = false);
  }

 ?>

<div class="wrap jw_admin_wrap">
          <?php if ($finish == true) { ?>
              <div class="success">
              Sede modificada correctamente!
            </div>
          <?php } ?>

            <h2>Editar Sede <?php echo($row->name); ?></h2>
            <form method="post" action="" enctype="multipart/form-data" class="form-sede-deragopyan">
                <p class="required">Ingresar todos los datos en los campos obligatorios (*) </p>

                   <div class="image">
                    <input type="text" name="nombre_sede" placeholder="Ingrese nombre de sede" value="<?php echo($row->name); ?>">
                    <h4>Imagen de sede</h4>
                    <p>Vista previa</p>
                        <img src="<?php echo($dir.$row->image) ?>" alt="" id="preview-sede-image">
                        <input type="file" name="image_sede" id="sede_file_image" >
                        <button>Subir imagen</button>
                   </div>
                   <button class="buttonDiv ubicacion-mapa">
                      Ubicación/Mapa
                   </button>
                   <div class="maps hidden">
                    <h4>Ubicación / Mapa</h4>
                          <input type="text" id="mapa_beneficio">
                          <select name="google_maps_ubication" id="results-google-maps" ></select>
                        <div id="map_canvas" style="width:50%; height:500px"></div>
                   </div>
                   <button class="buttonDiv horarios-sede ">
                      Horarios
                   </button>
                   <div class="horarios hidden">
                    <h4>Horarios</h4>
                       <div class="row1">
                         <?php include "horarios.php" ?>
                       </div>
                       <div class="row2">
                          <h4>Preview Horarios</h4>
                          <div class="hora"></div>
                          <div class="dias"></div>
                          <div class="rangeDays"></div>
                          <h4>Horarios definidos</h4>
                          <div class="definidos"></div>
                       </div>
                   </div>
                   <button class="buttonDiv medios-sede">
                      Medios
                   </button>
                   <div class="medios hidden">
                    <select id="SeleccionarMedio">
                       <option value="MediosDeContacto[Fax][]">Fax</option>
                       <option value="MediosDeContacto[Telefono][]">Telefono</option>
                       <option value="MediosDeContacto[Email][]">Email</option>
                     </select>
                     <button id="AgregarMedio"><i class="fa fa-plus"></i> Agregar</button>
                     <div class="newMedios">
                       <?php 
                      if ($medios) : 
                       foreach ($medios as $mdk => $mdv) : 
                              foreach ($mdv as $smdk => $smdv): 
                                        echo('<div>
                                                <input type="text" name="MediosDeContacto['.$mdk.'][]" value="'.$smdv.'">
                                                  <button class="unsetInput">
                                                    <i class="fa fa-times"></i>
                                                  </button>
                                            </div>');
                            endforeach;
                         endforeach;
                        endif;
                      ?>
                     </div>
                   </div>
                   
                <input type="hidden" name="sedes_deragopyan_submit" value="1">
                <input type="hidden" name="post_value" value="<?php echo($row->id); ?>">
                <input type="hidden" name="horarios" value='<?php echo($row->horarios); ?>' id="sede_deragopyan_horario">
                <input type='submit' value='Guardar Sede' class='green_btn green_solid'>
            </form>
        </div>


   <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD4Up6VW3d1hL9aC5wk1E2APbW5_P-ZqxM&sensor=false">
</script>
        <script>

          jQuery(document).ready(function($) {
            var timeCount = 0;
            var find = "";
            var Maps = new googleMapsApi("map_canvas");
            
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
                Maps.setLocation(map.lat, map.lgn);
              };
            });

            // $.get('http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=true_or_false', function(data) {
            //   console.log(data);
            // });
          });
        </script>



<?php } ?>