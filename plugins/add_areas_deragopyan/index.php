<?php 
/*-------------------------------------------------------------------------

   Plugin Name: User Areas
   Description: Custom
   Version: 1.3.2
   Plugin URI: 
   Author: Ezequiel Romero
   Author URI: 
   License: Under GPL2

--------------------------------------------------------------------------*/

add_action( "admin_menu", "add_areas_deagopyan" );

require_once(plugin_dir_path(__FILE__)."class/class.areas-categorias.php");




function add_areas_deagopyan(){
	add_users_page( 
  "Areas administrativas",
   "Categorias/areas",
   "read",
   "menu-areas-deragopyan",
   "menu_areas_deragopyan" 
   );
}


// FRONT ------------------------------------------------------------
function menu_areas_deragopyan(){
$areas = new AreasCategoriasManager();

?>
<div class="agrega-areas-deragopyan">

  <div>
    <h3>Categorias/areas de usuarios</h3>
    <h4>Agregar Categorias</h4>
    <input type="text" class="valueInsert inputcategoria">
    <input type="hidden" value="categoria">
    <button class="insert">Agregar</button>
    <h4>Lista de Categorias</h4>
    <ul class="list" id="categoria">
      <?php $areas->getOptionsCategorias(); ?>
    </ul>
  </div>

	<div>
    <h4>Agregar Areas</h4>
    <input type="text"  class="valueInsert inputarea">
    <input type="hidden" value="area">
    <button class="insert">Agregar</button>
    <h4>Lista de Areas</h4>
    <ul class="list" id="area">
     <?php $areas->getOptionsAreas(); ?>
    </ul> 
  </div>

<div class="assign-areas">
  <h3>Asignación de area por usuario</h3>
  <div class="table menu">
      <div class="row">
          <div class="cell id">ID</div>
          <div class="cell username">USERNAME</div>
          <div class="cell categoria">CATEGORIA DE USUARIOS</div>
          <div class="cell area">AREA</div>
          <div class="cell status">ESTADO</div>
      </div>
  </div>
  <div class="table results">
    <?php foreach($areas->getUsers() as $k => $v): ?>
      <div class="row">
          <div class="cell id"><?php echo($v->id) ?></div>
          <div class="cell username"><?php echo($v->nickname) ?></div>
          <div class="cell categoria">
             <select class="user_categoria"><?php $areas->getOptionsCategorias(2,$v->categoria) ?></select>
          </div>
          <div class="cell area">
            <select class="user_area">
                <?php $areas->getOptionsAreas(2,$v->area) ?>
            </select>
          </div>
          <div class="cell status"></div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
    
</div>


<?php
}
// FRONT ------------------------------------------------------------




// Agrego los styles y js

function areas_deragopyan_style() {
	wp_register_style( 'areas_deragopyan-css', plugins_url( 'css/users_areas_deragopyan.css',__FILE__ ) );
	if (is_admin()): 
    wp_enqueue_style( 'areas_deragopyan-css' );
	endif;//!is_admin
}
function areas_deragopyan_scripts(){
  wp_register_script("areas_deragopyan-js",plugins_url("js/users_areas_deragopyan.js",__FILE__) );
  if (is_admin()) {
    wp_enqueue_script("areas_deragopyan-js");
  }
}

add_action( 'wp_print_scripts', 'areas_deragopyan_style' );
add_action( 'wp_print_scripts', 'areas_deragopyan_scripts' );

add_action( 'wp_ajax_categorias_areas', 'categorias_areas' );
 
function categorias_areas(){
  $areas = new AreasCategoriasManager();
  switch ($_POST["classAction"]) {
    case 'insert':
     print($areas->insert($_POST));
      break;
     case 'save':
      $areas->update($_POST);
      break;
    case 'delete':
      $areas->delete($_POST);
      break;
    case 'update_user':
      $areas->updateUser($_POST);
      break;
  }
  die();
}


?>