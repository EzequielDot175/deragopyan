<?php 
/*
Plugin Name: Procedimientos deragopyan
Plugin URI: https://github.com/fyaconiello/wp_plugin_template
Description: A simple wordpress plugin template
Version: 1.0
Author: Ezequiel Romero
Author URI: 
*/
define('TEM_PATH', get_template_directory());
define('TEM_URI', get_template_directory_uri());
define('IMG', get_template_directory_uri()."/img/");
if(!class_exists("Procedimientos")):
	/**
	* 
	*/
	class Procedimientos
	{
        private $parents;
        private $childrens;
        private $level;
        private $count;

		public $_meta	= array(
			'meta_tipo_proceso',
            'meta_proceso_pg',
            'meta_proceso_perfiles'

		);

		public function __construct()
		{
            add_action('init', array($this, 'init'));
            add_action('init',array($this,"taxonomy"));
            add_action("wp_print_scripts", array($this,"registerScripts"));
            add_action("wp_ajax_nopriv_getmenu", array($this,"getmenu") );
            add_action("wp_ajax_getpostsbycategory", array($this,"getpostsbycategory") );
            add_action("wp_ajax_nopriv_getpostsbycategory", array($this,"getpostsbycategory") );
            add_action("wp_ajax_getpostsbykey", array($this,"getpostsbykey") );
            add_action("wp_ajax_nopriv_getpostsbykey", array($this,"getpostsbykey") );
            add_action("add_meta_boxes", array($this,"addmetabox") );
            add_action( 'save_post', 'prfx_meta_save' );

            // ajax front
            add_action("wp_ajax_stepone", array($this,"stepone") );
            add_action("wp_ajax_nopriv_stepone", array($this,"stepone") );



		}

        public function initPost() {
            global $current_user;
            
            $labels = array(
                'name'                => __( 'Procedimientos', 'text-domain' ),
                'singular_name'       => __( 'Procedimiento', 'text-domain' ),
                'add_new'             => _x( 'Nuevo procedimiento', 'text-domain', 'text-domain' ),
                'add_new_item'        => __( 'Nuevo procedimiento', 'text-domain' ),
                'edit_item'           => __( 'Editar un procedimiento', 'text-domain' ),
                'new_item'            => __( 'Nuevo procedimiento', 'text-domain' ),
                'view_item'           => __( 'Ver procedimiento', 'text-domain' ),
                'search_items'        => __( 'Buscar procedimientos', 'text-domain' ),
                'not_found'           => __( 'Procedimiento no encontrado', 'text-domain' ),
                'not_found_in_trash'  => __( 'Procedimiento eliminado no encontrado', 'text-domain' ),
                'parent_item_colon'   => __( 'Parent Singular Name:', 'text-domain' ),
                'menu_name'           => __( 'Procedimientos', 'text-domain' ),
            );
        
            $args = array(
                'labels'              => $labels,
                'hierarchical'        => false,
                'description'         => 'Procedimientos deragopyan',
                'taxonomies'          => array("procedimientos-categorias"),
                'public'              => false,
                'show_ui'             => false,
                'show_in_menu'        => false,
                'show_in_admin_bar'   => false,
                'menu_position'       => null,
                'menu_icon'           => null,
                'show_in_nav_menus'   => true,
                'publicly_queryable'  => true,
                'public'              => true,
                'exclude_from_search' => false,
                'show_ui'             => true,
                'has_archive'         => true,
                'show_in_menu'        => true,
                'query_var'           => true,
                'show_in_admin_bar'   => true,
                'can_export'          => true,
                'rewrite'             => true,
                'capability_type'     => 'post',
                'supports'            => array(
                    'title', 'editor', 'author', 'thumbnail',
                    'excerpt',
                    'revisions', 'page-attributes', 'post-formats'
                    )
            );
            
            register_post_type( 'procedimientos', $args );


        }
       

        
       
        /**
         * Create a taxonomy
         *
         * @uses  Inserts new taxonomy object into the list
         * @uses  Adds query vars
         *
         * @param string  Name of taxonomy object
         * @param array|string  Name of the object type for the taxonomy object.
         * @param array|string  Taxonomy arguments
         * @return null|WP_Error WP_Error if errors, otherwise null.
         */

        public function getPostsByKey(){
            if (isset($_POST["keywords"])):
                global $wpdb;
                $sql = "SELECT post_content as content, post_title as title FROM wp_posts WHERE post_type = 'procedimientos' AND post_content LIKE ";
                $i = 0;
                $keywords = "";
                foreach($_POST["keywords"] as $k => $v):
                    if($i == 0):
                        $sql .= "'%".$v."%'";
                        $i++;
                        $keywords .= $v;
                    else:
                        $sql .= " OR '%".$v."%'";
                        $keywords .= ", ".$v;
                    endif;
                endforeach;
                $rows = $wpdb->get_results($sql,ARRAY_A);
                    $h2 = sprintf("<h2>Resultados obtenidos de : %s</h2>",$keywords);
                    echo($h2);
                foreach($rows as $k => $v):
                    echo("<h2>".$v["title"]."</h2>");
                    echo(apply_filters("the_content", $v["content"]));
                    echo("<hr>");
                endforeach;
            endif;
            die();
        }
        public function getPostsByCategory(){
            if (isset($_POST["id"]) && isset($_POST["action"]) && $_POST["action"] == "getpostsbycategory"):
                $id = (int)$_POST["id"];
                global $wpdb;
                $sql = "SELECT 
                            wpot.post_content as content,
                            wpot.post_title as title
                        FROM 
                            wp_term_relationships as wptsh
                        LEFT JOIN 
                            wp_posts as wpot ON wpot.id = wptsh.object_id
                        WHERE 
                            wptsh.term_taxonomy_id = ".$id;
                $rows = $wpdb->get_results($sql,ARRAY_A);

                foreach ($rows as $k => $v):
                    echo("<h2>".$v["title"]."</h2>");
                    echo(apply_filters("the_content", $v["content"]));
                    echo("<hr>");
                endforeach;
            endif;
            die();
        } 
        public function taxonomy() {
        
            $labels = array(
                'name'                    => _x( 'Categorías', 'Categorías', 'text-domain' ),
                'singular_name'            => _x( 'Categoría', 'Taxonomy singular name', 'text-domain' ),
                'search_items'            => __( 'Buscar Categorías', 'text-domain' ),
                'popular_items'            => __( 'Categorías populares', 'text-domain' ),
                'all_items'                => __( 'Todas Categorías', 'text-domain' ),
                'parent_item'            => __( null, 'text-domain' ),
                'parent_item_colon'        => __( null, 'text-domain' ),
                'edit_item'                => __( 'Editar categoría', 'text-domain' ),
                'update_item'            => __( 'Actualizar categoría', 'text-domain' ),
                'add_new_item'            => __( 'Agregar nueva categoría', 'text-domain' ),
                'new_item_name'            => __( 'Nueva categoría', 'text-domain' ),
                'add_or_remove_items'    => __( 'Agregar o borrar categoría', 'text-domain' ),
                'choose_from_most_used'    => __( 'Elige la categoría mas usada', 'text-domain' ),
                'menu_name'                => __( 'Categorías', 'text-domain' ),
            );
        
            $args = array(
                'labels'            => $labels,
                'public'            => true,
                'show_in_nav_menus' => true,
                'show_admin_column' => true,
                'hierarchical'      => true,
                'show_tagcloud'     => true,
                'show_ui'           => true,
                'query_var'         => true,
                'rewrite'           => array("slug"=> "procedimientos-categorias"),
                'query_var'         => true
            );
        
            register_taxonomy( 'procedimientos-categorias','procedimientos', $args );
        }
        
        public function registerScripts(){
           wp_register_style("procedimientos-css", plugins_url( "css/procedimientos.css",__FILE__ ) );
            wp_enqueue_style("procedimientos-css");

            wp_register_script("front-js",plugins_url("js/P_front.js",__FILE__ ) );
            wp_enqueue_script("front-js");
        }
        public function setTypeProcess($columns){
                $columns["type_process"] = __( 'Tipo de proceso' );
                $columns["status"] = __( 'Estado' );
                return $columns;
        }
        public function addMetaBox(){
            add_meta_box( 'proceso_meta', __( 'Tipo de procedimiento', 'prfx-textdomain' ), array($this,'metaBoxView'), 'procedimientos' );
        }
        public function metaBoxView( $post ){
            wp_nonce_field( basename( __FILE__ ), 'tipo_proceso_nonce' );
            require plugin_dir_path(__FILE__).'/parts/box.php';
        }
        public function saveMetaBox( $post_id ){
             // Checks save status

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // die();


        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'tipo_proceso_nonce' ] ) && wp_verify_nonce( $_POST[ 'tipo_proceso_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';
     
        // Exits script depending on save status
        if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
            return;
        }
     
        // Checks for input and sanitizes/saves if needed
        if( isset( $_POST[ 'meta_tipo_proceso' ] ) ) {
            update_post_meta( $post_id, 'meta_tipo_proceso', sanitize_text_field( $_POST[ 'meta_tipo_proceso' ] ) );
        }
        // if( isset( $_POST[ 'meta_proceso_perfiles' ] ) ) {
        //     echo "<pre>";
        //     print_r($_POST);
        //     echo "</pre>";
        //     die();
        //     update_post_meta( $post_id, 'meta_proceso_perfiles', sanitize_text_field( $_POST[ 'meta_proceso_perfiles' ] ) );
        // }
 
        }
		public function init()
    	{
    		$this->initPost();
    		add_action('save_post', array($this, 'save_post'));
            add_filter("manage_edit-procedimientos_columns",array($this,"setTypeProcess"));
            add_action( 'manage_procedimientos_posts_custom_column', array($this,"manageCustomColumns"), 10, 2 );

    	}
        public function manageCustomColumns($column, $post_id){
            global $post;

            switch ($column) {
                case 'type_process':
                    $tipo_proceso = get_post_meta( $post_id, 'meta_tipo_proceso', true );
                    echo($tipo_proceso);
                    break;
                
                default:
                    # code...
                    break;
            }
        }
        public function detailsByIdDirectorio(){

            die();
        }
    	public function save_post($post_id)
    	{

            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }
            
    		if(isset($_POST['post_type']) && $_POST['post_type'] == "procedimientos" && current_user_can('edit_post', $post_id))
    		{
    			foreach($this->_meta as $field_name)
    			{
    				update_post_meta($post_id, $field_name, $_POST[$field_name]);
    			}
    		}
    		else
    		{
    			return;
    		}
            if(isset($_POST["meta_proceso_perfiles"])):
                update_post_meta($post_id, 'meta_proceso_perfiles', json_encode($_POST["meta_proceso_perfiles"]));
            endif;
    	}
        public function getView(){
            require plugin_dir_path(__FILE__).'/parts/main-view.php';
        }
    	public function activate(){

    	}
    	public function deactivate(){
    		
    	}
    	
        // Ajax FRONT

        public function stepOne(){
            if (isset($_POST["action"]) && $_POST["action"] == "stepone"):
                global $wpdb;
                $id = (int)$_POST["id"];
                $sql = 'SELECT 
                    WPT.name as nombre,
                    WPTX.term_taxonomy_id as id
                FROM 
                    wp_term_taxonomy AS WPTX
                LEFT JOIN 
                    wp_terms as WPT ON WPT.term_id = WPTX.term_taxonomy_id 
                WHERE
                    WPTX.parent = '.$id.' AND taxonomy = "procedimientos-categorias"';

                // echo($sql);
                $rows = $wpdb->get_results($sql);
                echo(json_encode($rows));
            endif;
            die();
        }


        // FRONT METHODS

        public static function getMenuLeft(){
            global $wpdb;
            return $wpdb->get_results('SELECT 
                WPT.name as nombre,
                WPTX.term_taxonomy_id as id
            FROM 
                wp_term_taxonomy AS WPTX
            LEFT JOIN 
                wp_terms as WPT ON WPT.term_id = WPTX.term_taxonomy_id 
            WHERE
                WPTX.parent = 0 AND taxonomy = "procedimientos-categorias"');


        }


	}

endif;

if(class_exists("Procedimientos")):
	register_activation_hook(__FILE__, array("Procedimientos", "activate") );
	register_deactivation_hook(__FILE__, array("Procedimientos", "deactivate") );
	$wp_plugin_template = new Procedimientos();
endif;

?>