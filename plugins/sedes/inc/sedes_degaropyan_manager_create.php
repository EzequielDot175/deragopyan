<?php function sedes_degaropyan_manager_create(){
   

    if (isset($_POST["sedes_deragopyan_submit"])) {
        if ($_POST["sedes_deragopyan_submit"] == 1) {


            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            $nombre_sede = sanitize_text_field($_POST["nombre_sede"]);
            $email_sede = sanitize_text_field($_POST["email_sede"]);
            $horarios = $_POST["horarios"];
            $MediosDeContacto = serialize($_POST["MediosDeContacto"]);
            $maps =  $_POST["google_maps_ubication"];
            $dir = wp_upload_dir();
            $files = $_FILES["image_sede"];
            $image_name = ( !empty($files["name"]) ? $files["name"] : "sedes-default.png");

            if($image_name != "sedes-default.png"):
            move_uploaded_file($files["tmp_name"], $dir["basedir"]."/sedes/".$files["name"]);
              
            endif;

            global $wpdb;
            $sql = "INSERT INTO 
                      ".$wpdb->prefix."sedes_degaropyan 
                    (name,image,horarios,mediosdecontacto,maps) 
                      VALUES 
                    ('".$nombre_sede."','".$image_name."','".$horarios."','".$MediosDeContacto."','".$maps."')";
            $query = $wpdb->query($sql);
            if ($query) {
              $finish = true;
            }
        }
    }
?>
        <script>
          jQuery(document).ready(function($) {
            $('.form-sede-deragopyan').on('submit', function(event) {
              var nombre = $('input[name="nombre_sede"]').val();
              var imagen = $('#preview-sede-image').attr('src');
              function emptyInput(val){if (val == "" || val == undefined) {return true}else{return false}};
              if (emptyInput(nombre)) {
                alert("El campo nombre es obligatorio");
                event.preventDefault();
              }

              
            });
          });
        </script>
        <div class="wrap jw_admin_wrap">
          <?php if ($finish == true) { ?>
              <div class="success">
              Sede creada correctamente!
            </div>
          <?php } ?>

            <h2>Crear nueva Sede</h2>
            <form method="post" action="" enctype="multipart/form-data" class="form-sede-deragopyan">
                <p class="required">Ingresar todos los datos en los campos obligatorios (*) </p>

                   <div class="image">
                    <input type="text" name="nombre_sede" placeholder="Ingrese nombre de sede">
                    <h4>Imagen de sede</h4>
                    <p>Vista previa</p>
                        <img src="" alt="" id="preview-sede-image">
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

                  <button class="buttonDiv especialidades">
                      Especialidades
                   </button>
                   <div class="especialidades">
                      <h4>Seleccionar especialidad</h4>
                      <div class="box-esp">
                          <div class="row-esp">
                            <select name="sedes_especialidades-1">
                               <?php sedes_deragopyan_get_especialidades(); ?>
                             </select>
                             <a href="#" class="sede-especialidades-1"><span class="dashicons dashicons-dismiss"></span></a>
                          </div>
                      </div>
                     <br>
                     <button id="add-new-esp">Agregar nueva especialidad</button>
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
                      Medios de contacto
                   </button>
                   <div class="medios hidden">
                     <select id="SeleccionarMedio">
                       <option value="MediosDeContacto[Fax][]">Fax</option>
                       <option value="MediosDeContacto[Telefono][]">Telefono</option>
                       <option value="MediosDeContacto[Email][]">Email</option>
                     </select>
                     <button id="AgregarMedio"><i class="fa fa-plus"></i> Agregar</button>
                     <div class="newMedios"></div>
                   </div>
                <input type="hidden" name="sedes_deragopyan_submit" value="1">
                <input type="hidden" name="horarios" value='' id="sede_deragopyan_horario">
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

            var clone_esp = $('.row-esp').clone(true, true);

            console.log(clone_esp);

            $('#add-new-esp').click(function(event) {
              event.preventDefault();
                console.log($('select[name="sedes_especialidades-1"]'));
            });




          });
        </script>



<?php }?>