<?php
/*-------------------------------------------------------------------------

   Plugin Name: Sedes Deragopyan
   Description: Custom
   Version: 1.3.2
   Plugin URI: 
   Author: Ezequiel Romero
   Author URI: 
   License: Under GPL2

--------------------------------------------------------------------------*/

define(IMG_SEDES, wp_upload_dir()["baseurl"]."/sedes/");

add_action('admin_menu','sedes_degaropyan_administracion');
function sedes_degaropyan_administracion() {
	//this is the main item for the menu
	add_menu_page('Sedes Degaropyan', //page title
	'Sedes Degaropyan', //menu title
	'manage_options', //capabilities
	'sedes_degaropyan_manager', //menu slug
	'sedes_degaropyan_manager', //function
	plugin_dir_url( __FILE__ ) . 'images/panel.png'
	);
	//this is a submenu
	
	add_submenu_page('sedes_degaropyan_manager',
	'Agregar Sede',
	'Agregar Sede',
	'manage_options',
	'sedes_degaropyan_manager_create',
	'sedes_degaropyan_manager_create'
	);
  add_submenu_page('sedes_degaropyan_manager',
  'Especialidades',
  'Especialidades',
  'manage_options',
  'sedes_degaropyan_manager_especialidad',
  'sedes_degaropyan_manager_especialidad'
  );
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //page title
	'Editar Sede',
	'Editar Sede', //menu title
	'manage_options', //capabilities
	'sedes_degaropyan_edit', //menu slug
	'sedes_degaropyan_edit' //function
	);
  add_submenu_page(null, //page title
  'Borrar Sede',
  'Borrar Sede', //menu title
  'manage_options', //capabilities
  'remove_sedes_degaropyan_manager', //menu slug
  'remove_sedes_degaropyan_manager' //function
  );

  add_submenu_page(null, //page title
  'Crear Especialidad',
  'Crear Especialidad', //menu title
  'manage_options', //capabilities
  'sedes_degaropyan_add_esp', //menu slug
  'sedes_degaropyan_add_esp' //function
  );

  add_submenu_page(null, //page title
  'Editar Especialidad',
  'Editar Especialidad', //menu title
  'manage_options', //capabilities
  'sedes_degaropyan_edit_esp', //menu slug
  'sedes_degaropyan_edit_esp' //function
  );

  add_submenu_page(null, //page title
  'Editar Especialidad',
  'Editar Especialidad', //menu title
  'manage_options', //capabilities
  'sedes_degaropyan_rem_esp', //menu slug
  'sedes_degaropyan_rem_esp' //function
  );


}
function sedes_unscript_medios($valSerial){
  $medios = "";
   foreach (unserialize($valSerial) as $k => $medios_pre) {
          $medios .="<h4 class ='mediosTitle'>".$k."</h4>";
            foreach ($medios_pre as $z => $mediosdata) {
              $medios .= '<div class="mediosData">'.$mediosdata.'</div>';
            }
        }
  return  $medios;
}


function sedes_unscript_horarios($horarios){
  $decode = json_decode($horarios);
  $html = '<div class="horariosPack">';
  $packDiasHtml = "";
  // print_r($decode);
  foreach ($decode as $key => $packDia) :

      if (!empty($packDia->dias)):
          $num = count($packDia->dias);
         if ($num > 1) :
            foreach ($packDia->dias as $k => $dias) :
                if ($k == 0) :
                  $html .= " <span class='span_dias'>".$dias."</span>";
                elseif ($k > 0 && $k != $num-1) :
                  $html .= ", <span class='span_dias'>".$dias."</span>";
                else:
                  $html .= " y <span class='span_dias'>".$dias."</span>";
                endif;
            endforeach;
        else:
          $html .= " <span class='span_dias'> ".$dias." </span> ";
        endif;
      endif;

      if (!empty($packDia->rangoDias)):
          $num = count($packDia->rangoDias);
        if ($num > 1) :
            foreach ($packDia->rangoDias as $k => $rangoDias) :
                if ($k == 0) :
                  $html .= " <span class='span_rango'>".$rangoDias."</span> ";
                elseif ($k > 0 && $k != $num-1) :
                  $html .= ", <span class='span_rango'>".$rangoDias."</span> ";
                else:
                  $html .= " y <span class='span_rango'>".$rangoDias."</span> ";
                endif;
            endforeach;
        else:
          $html .= " <span class='span_rango'>".$rangoDias."</span> ";
        endif;
      endif;

      if (!empty($packDia->horas)):
          $num = count($packDia->horas);
        if ($num > 1) :
            foreach ($packDia->horas as $k => $horas) :
                $horaFormat = str_replace(" - ", " a ", $horas);
                if ($k == 0) :
                  $html .= " de <span class='span_horas'>".$horaFormat."</span>";
                elseif ($k > 0 && $k != $num-1) :
                  $html .= ", <span class='span_horas'>".$horaFormat."</span>";
                else:
                  $html .= " y <span class='span_horas'>".$horaFormat."</span>";
                endif;
            endforeach;
        else:
          $html .= " <span class='span_horas'>".$horaFormat."</span>";
        endif;
      endif;

    $html .= "</div>";
    $packDiasHtml[] = $html;

  endforeach;
  $finalHtml = "";
  foreach ($packDiasHtml as $k => $dias) :
    $finalHtml .= $dias;
  endforeach;
  return $finalHtml;
}
function getCountOptionSedes($id){
      global $wpdb;
      $sql = "SELECT COUNT(id) FROM wp_directorio WHERE dir_sede = ".$id;
      $result =  $wpdb->get_var($sql);
      if($result > 0):
        return "(".$result.")";
      endif;
}
function sedes_deragopyan_options_fetch($id = null,$withCount = false){
  global $wpdb;
  $row = $wpdb->get_results("SELECT id,name FROM ".$wpdb->prefix."sedes_degaropyan ");
  $html = "";
  if (!is_null($id)) :
    foreach ($row as $key => $value) :
      if($value->id == $id):
        $html .= "<option value='".$value->id."' selected>".$value->name."</option>";
      else:
        $html .= "<option value='".$value->id."'>".$value->name."</option>";
      endif;
    endforeach;
  else:
    if($withCount):
        echo("asd");
        foreach ($row as $key => $value) :
            $html .= "<option value='".$value->id."'>".$value->name." ".getCountOptionSedes($value->id)."</option>";
        endforeach;
      else:
         foreach ($row as $key => $value) :
          $html .= "<option value='".$value->id."'>".$value->name."</option>";
        endforeach;
    endif;
  endif;
  echo($html);
}
function getDataSedes(){
  global $wpdb;
  return $wpdb->get_results("SELECT * FROM wp_sedes_degaropyan");
}
function sedes_deragopyan_fetch_results($format = null){
  

  global $wpdb;
  if (!isset($_GET["sede_deragopyan"])) {
      $body = '<div class="sedes_container">
      <h3 class="sede_title">%name%</h3>
        <a href="?sede_deragopyan=%id%"><img src="%image%" alt="" ></a>
        <div class="sede_contact">%contact%</div>
      </div>';
      $row = $wpdb->get_results("SELECT id,name,image,mediosdecontacto FROM ".$wpdb->prefix."sedes_degaropyan ");
      foreach ($row as $key => $value) {
        $id = $value->id;
        $name = $value->name;
        $image = $value->image;
        $mediosHTML = "";
        $medios = sedes_unscript_medios($value->mediosdecontacto);
        $maquetado = str_replace("%name%", $name, $body);
        $upload_dir = wp_upload_dir();
        $maquetado = str_replace("%image%", $upload_dir["url"]."/".$image , $maquetado);
        $maquetado = str_replace("%contact%", $medios, $maquetado);
        $maquetado = str_replace("%id%", $id, $maquetado);
        if ($format == "data") {
          $data_sedes[] = $value; 
          return $data_sedes;
        }
        else{
          echo($maquetado);
        }
      }
  }elseif (isset($_GET["sede_deragopyan"]) && is_numeric(htmlspecialchars($_GET["sede_deragopyan"]))) {
    $body = '<div class="sede_deragopyan_detallado">
      <h1 class="sede_deragopyan_detallado_title">%name%</h1>
      <img src="%image%" class="sedes_detallado_imagen" alt="">
      <div class="contacto_detallado">%mediosdecontacto%</div>
      <div class="horarios_detallado">%horarios%</div>
      <div class="maps_detallado">%maps%</div>
    </div>';
    $id = (int)$_GET["sede_deragopyan"];
    $sql = "SELECT * FROM ".$wpdb->prefix."sedes_degaropyan WHERE id = ".$id;
    $result = $wpdb->get_results($sql);
    $sede = $result[0];
    $horarios = sedes_unscript_horarios($sede->horarios);
    $mediosdecontacto = sedes_unscript_medios($sede->mediosdecontacto);
    $upload_dir = wp_upload_dir();
    $html = str_replace("%name%", $sede->name, $body);
    $html = str_replace("%image%", $upload_dir["url"]."/".$sede->image, $html);
    $html = str_replace("%mediosdecontacto%", $mediosdecontacto , $html);
    $html = str_replace("%horarios%", $horarios , $html);
    $html = str_replace("%maps%", $sede->maps , $html);
    echo($html);

  }
} // END FUNCTION

//endshortcode
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_degaropyan_manager_create.php');
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_degaropyan_manager.php');
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_degaropyan_manager_especialidad.php');
require_once(plugin_dir_path(__FILE__) . 'inc/remove_sedes_degaropyan_manager.php');
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_degaropyan_edit.php');
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_especialidad_create.php');
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_especialidad_edit.php');
require_once(plugin_dir_path(__FILE__) . 'inc/sedes_especialidad_delete.php');

function sedes_degaropyan_plugin_scripts(){
  // wp_register_script("jquery-deragopyan",plugins_url("js/jquery-1.11.2.min.js",__FILE__) );
  wp_register_script("sedes-deragopyan-admin",plugins_url("js/scripts-sedes-deragopyan.js",__FILE__) );
  if (is_admin()) {
    // wp_enqueue_script("jquery-deragopyan");
    wp_enqueue_script("sedes-deragopyan-admin");
  }
}

function sedes_deragopyan_get_especialidades(){
  global $wpdb;
  $row = $wpdb->get_results("SELECT * FROM wp_sedes_especialidades");
  foreach($row as $k => $v):
    echo('<option value="'.$v->id.'">'.$v->esp_name.'</option>');
  endforeach;
}

add_action( 'wp_print_scripts', 'sedes_degaropyan_plugin_scripts' );
add_action( 'wp_print_scripts', 'sedes_degaropyan_plugin_styles' );
function sedes_degaropyan_plugin_styles() {
	wp_register_style( 'degaroypan-style', plugins_url( 'css/sedes_degaropyan_main.css',__FILE__ ) );
	if (!is_admin()): 
    wp_enqueue_style( 'degaroypan-style' );
	endif;//!is_admin

  wp_register_style( 'degaropyan-font-awesome', plugins_url( 'css/sedes_degaropyan_font-awesome.min.css',__FILE__ ) );
	wp_register_style( 'degaroypan-style-admin', plugins_url( 'css/sedes_degaropyan_style-admin.css',__FILE__ ) );
	if (is_admin()): 
  wp_enqueue_style( 'degaropyan-font-awesome' );
	wp_enqueue_style( 'degaroypan-style-admin' );
  endif; //is_admin
}


?>