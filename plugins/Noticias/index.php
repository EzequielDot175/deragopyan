<?php 
/*
Plugin Name: Noticias deragopyan
Plugin URI: 
Description:
Version: 1.0
Author: Ezequiel Romero
Author URI: 
*/
if(!class_exists("Noticias")):
	/**
	* 
	*/
	class Noticias
	{

        public $error = "";

		public function __construct(){
			add_action('init', array($this, 'init'));
            add_action('init',array($this,"taxonomy"));
            add_action("init",array($this, "registerScripts") );

		}


		public function initPost(){
            global $current_user;

			$labels = array(
                'name'                => __( 'Noticias', 'text-domain' ),
                'singular_name'       => __( 'Noticia', 'text-domain' ),
                'add_new'             => _x( 'Nueva Noticia', 'text-domain', 'text-domain' ),
                'add_new_item'        => __( 'Nueva Noticia', 'text-domain' ),
                'edit_item'           => __( 'Editar un Noticia', 'text-domain' ),
                'new_item'            => __( 'Nueva Noticia', 'text-domain' ),
                'view_item'           => __( 'Ver Noticia', 'text-domain' ),
                'search_items'        => __( 'Buscar Noticias', 'text-domain' ),
                'not_found'           => __( 'Noticia no encontrado', 'text-domain' ),
                'not_found_in_trash'  => __( 'Noticia eliminado no encontrado', 'text-domain' ),
                'parent_item_colon'   => __( 'Parent Singular Name:', 'text-domain' ),
                'menu_name'           => __( 'Noticias', 'text-domain' ),
            );
            
            $args = array(
                'labels'              => $labels,
                'hierarchical'        => false,
                'description'         => 'Noticias deragopyan',
                'taxonomies'          => array("Noticias-categorias","Noticias-etiquetas"),
                'public'              => false,
                'show_ui'             => false,
                'show_in_menu'        => false,
                'show_in_admin_bar'   => false,
                'menu_position'       => null,
                'menu_icon'           => null,
                'show_in_nav_menus'   => false,
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
                    'excerpt','custom-fields', 'trackbacks', 'comments',
                    'revisions', 'page-attributes', 'post-formats'
                    )
            );
           
        
            register_post_type( 'noticias', $args );

		}
        public function getCurrentUser(){
            global $current_user;
            echo "<pre>";
            print_r($current_user);
            echo "</pre>";

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
                'rewrite'           => array("slug"=> "noticias-categorias"),
                'query_var'         => true
            );
        
            register_taxonomy( 'noticias-categorias','noticias', $args );

            $labels1 = array(
                'name'                    => _x( 'Etiquetas', 'Etiquetas', 'text-domain' ),
                'singular_name'            => _x( 'etiqueta', 'Taxonomy singular name', 'text-domain' ),
                'search_items'            => __( 'Buscar Etiquetas', 'text-domain' ),
                'popular_items'            => __( 'Etiquetas populares', 'text-domain' ),
                'all_items'                => __( 'Todas Etiquetas', 'text-domain' ),
                'parent_item'            => __( null, 'text-domain' ),
                'parent_item_colon'        => __( null, 'text-domain' ),
                'edit_item'                => __( 'Editar etiqueta', 'text-domain' ),
                'update_item'            => __( 'Actualizar etiqueta', 'text-domain' ),
                'add_new_item'            => __( 'Agregar nueva etiqueta', 'text-domain' ),
                'new_item_name'            => __( 'Nueva etiqueta', 'text-domain' ),
                'add_or_remove_items'    => __( 'Agregar o borrar etiqueta', 'text-domain' ),
                'choose_from_most_used'    => __( 'Elige la etiqueta mas usada', 'text-domain' ),
                // 'menu_name'                => __( 'Etiquetas', 'text-domain' ),
            );
        
            $args1 = array(
                'labels'            => $labels1,
                'hierarchical'      => false,
                'show_ui'           => true,
                'query_var'         => true,
                'rewrite'           => array("slug"=> "noticias-etiquetas")
            );
        
            register_taxonomy( 'noticias-etiquetas','noticias', $args1 );
        }
        public function registerScripts(){

            wp_register_script("slide-noticias-js", plugins_url("script/foundation.min.js",__FILE__ ) );
            wp_enqueue_script("slide-noticias-js");

            wp_register_script("main-noticias-js", plugins_url("script/main.js",__FILE__ ) );
            wp_enqueue_script("main-noticias-js");
        }
        public function init()
    	{
    		$this->initPost();
    		add_action('save_post', array($this, 'save_post'));
    	}
        public function searchByContent(){
            if(isset($_GET["search"])):
                global $wpdb;
                $like = get_query_var("search","all");
                $like = explode(" ", $like);
                $sql = "SELECT post_content as content, post_title as title, post_date as pDate  FROM wp_posts WHERE (";
                foreach($like as $k => $v):
                    if($k == 0):
                        $sql .= "post_content LIKE '%".$v."%'";
                    else:
                        $sql .= " OR post_content LIKE '%".$v."%'";
                    endif;
                endforeach;
                $sql .=  ") AND post_type = 'noticias' ";
                $row = $wpdb->get_results($sql);
                
                if(!empty($row)):
                    foreach($row as $k => $v):
                        echo '<div>
                                <h4>'.$v->title.'</h4>
                                <div>'.apply_filters( "the_content", $v->content ).'</div>
                                <span>'.$v->pDate.'</span>
                            </div>';
                    endforeach;
                else:
                    $this->error = "Lo sentimos, no se han encontrado resultados.";
                endif;
            endif;
        }
        public function searchById(){
            if(isset($_GET["noticia"])):
                global $wpdb;
                $id = (int)$_GET["noticia"];
                $sql = "SELECT post_content as content, post_title  as title, post_date as pDate FROM wp_post WHERE id = ".$id;
                $row = $wpdb->get_var($sql);
                echo "<pre>";
                print_r($row);
                echo "</pre>";
            endif;
        }
        public function getList(){
            $args = array(
                    'post_type' => 'noticias',
                    'orderby' => 'post_date',
                    'order' => 'DESC'
                    );
            $posts = get_posts( $args );
            $html = "<ul>";
            foreach($posts as $k => $v):
                setup_postdata( $v );
            echo "<pre>";
            echo "</pre>";
                $html .= "
                <li>
                    <a href='".get_site_url()."/noticias/buscar-noticias/?noticia=".$v->ID."'>".$v->post_title."</a>
                    <span>".$v->post_date."</span>
                </li>";
            endforeach;
            $html .= "</ul>";

            echo $html;
            
        }
        public function getNormal(){
            global $wpdb;
            $sql = 'SELECT 
                        wps.post_title as title,
                        wps.post_excerpt as excerpt,
                        wps.post_content as content,
                        wps.id as id,
                        wtr.term_taxonomy_id as cat
                    FROM 
                        wp_posts as wps
                    LEFT JOIN 
                        wp_term_relationships as wtr ON wtr.object_id = wps.id
                    WHERE
                        wps.post_type = "noticias" AND wps.post_status = "publish" ORDER BY wps.post_date DESC LIMIT 3';
            $row = $wpdb->get_results($sql);

            foreach($row as $k => $v):
                if($v->cat == 27):
                    unset($row[$k]);
                endif;
            endforeach;

            return $row;
            
        }
        public function getDestacado($onlyData = false){
            global $wpdb;
            $sql = "SELECT 
                        post.id as id,
                        post.post_title as title,
                        post.post_date as pdate,
                        post.post_content as content,
                        post.post_excerpt as excerpt
                    FROM 
                        wp_term_relationships as wpterm
                    LEFT JOIN
                        wp_posts as post ON post.id = wpterm.object_id
                    WHERE
                        wpterm.term_taxonomy_id = 27 AND post.post_status = 'publish' ORDER BY post.post_date DESC LIMIT 3";
            $row = $wpdb->get_results($sql);
           if(!$onlyData):
            $html = "<ul>";
            foreach($row  as $k => $v):
                $html .= "<li>
                            <a href='".get_site_url()."/noticias/buscar-noticias/?noticia=".$v->id."'>".$v->title."</a>
                            <span>".$v->pdate."</span>
                        </li>";
            endforeach;
            $html .= "</ul>";
            echo $html;
            else:
                return $row ;
           endif;

        }

        public function slideshow(){
            $destacado = $this->getDestacado(true);
            $normal = $this->getNormal();

            require plugin_dir_path(__FILE__).'/inc/slider.php';
        }
        public function getNotas(){
            $args = array(
                    'category_name' => 'notas',
                    'orderby' => 'post_date',
                    'order' => 'DESC'
                    );
            $posts = get_posts( $args );
            $html = "<div class='nota'>";
            foreach($posts as $k => $v):
                $html .= "<h4>".$v->post_title."</h4>
                        <p>".apply_filters("the_content", $v->post_content )."</p>
                        <p>".$v->post_date."</p>
                    ";
            endforeach;
            $html .= "</div>";
            echo $html;
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
    	}

		public function activate(){}
		public function deactivate(){}

	}
endif;

if(class_exists("Noticias")):
	register_activation_hook(__FILE__, array("Noticias", "activate") );
	register_deactivation_hook(__FILE__, array("Noticias", "deactivate") );
	$wp_plugin_template = new Noticias();
endif;

 ?>