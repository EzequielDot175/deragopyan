<?php
if(!class_exists('PostLineaDeTiempo'))
{
	/**
	 * A PostTypeTemplate class that provides 3 additional meta fields
	 */
	class PostLineaDeTiempo
	{
		const POST_TYPE	= "postlineadetiempo";
		private $_meta	= array(
			'eventDate'
		);
		
    	/**
    	 * The Constructor
    	 */
    	public function __construct()
    	{
    		// register actions
    		add_action('init', array(&$this, 'init'));
    		add_action('admin_init', array(&$this, 'admin_init'));
    	} // END public function __construct()

    	/**
    	 * hook into WP's init action hook
    	 */
    	public function init()
    	{
    		// Initialize Post Type
    		$this->create_post_type();
    		add_action('save_post', array(&$this, 'save_post'));
    	} // END public function init()

    	/**
    	 * Create the post type
    	 */

    	public function create_post_type()
    	{
    		register_post_type(self::POST_TYPE,
    			array(
    				'labels' => array(
    					'name' => "Linea de tiempo",
    					'singular_name' => "Linea de tiempo"
    				),
    				'public' => true,
    				'has_archive' => true,
    				'description' => __("This is a sample post type meant only to illustrate a preferred structure of plugin development"),
    				'supports' => array(
    					'title', 'editor', 'excerpt',
    				),
                    'menu_icon' => plugin_dir_url(__FILE__)."timeline.png",
                    'menu_position' => 65 

    			)
    		);
    	}
        public function getPosts(){
            return get_posts(array("post_type"=> "postlineadetiempo"));
        }
        public static function wordCount($string, $limit) {
            return substr($string,0, $limit);
        }
        public static function getAllYearsOfEvents($limit = 650){
            global $wpdb;
            $sql = 'SELECT 
                        wpost.post_content as contenido,
                        wpost.post_title as titulo,
                        wpost.guid as link,
                        DATE_FORMAT(wpmeta.meta_value, "%d/%m") as fecha,
                        DATE_FORMAT(wpmeta.meta_value, "%Y") as año
                    FROM
                        wp_posts as wpost
                    LEFT JOIN
                        wp_postmeta as wpmeta ON wpmeta.post_id = wpost.id
                    WHERE
                        wpost.post_type = "postlineadetiempo" 
                    AND wpost.post_status = "publish" 
                    AND wpmeta.meta_key = "eventDate" 
                    ORDER BY wpmeta.meta_value DESC';
            $rows = $wpdb->get_results($sql);
            //print_r($rows);
            $years = array();
            for ($i=0; $i < count($rows); $i++):
                if(!in_array($rows[$i]->año, $years)):
                    $years[] = $rows[$i]->año;
                endif;
            endfor;
            $format = array();
            foreach ($rows as $k => $v):
                if(in_array($v->año, $years)):
                    $format[$v->año][$k]["fecha"] = $v->fecha;
                    $format[$v->año][$k]["contenido"] = self::wordCount(apply_filters("the_content",$v->contenido),$limit);
                    $format[$v->año][$k]["link"] = $v->link;
                    $format[$v->año][$k]["titulo"] = $v->titulo;
                endif;
            endforeach;
            return $format;

        }
	
    	/**
    	 * Save the metaboxes for this custom post type
    	 */
    	public function save_post($post_id)
    	{
            // verify if this is an auto save routine. 
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }
            
    		if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    		{
    			foreach($this->_meta as $field_name)
    			{
    				// Update the post's meta field
    				update_post_meta($post_id, $field_name, $_POST[$field_name]);
    			}
    		}
    		else
    		{
    			return;
    		} // if($_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    	} // END public function save_post($post_id)

    	/**
    	 * hook into WP's admin_init action hook
    	 */
    	public function admin_init()
    	{			
    		// Add metaboxes
    		add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
    	} // END public function admin_init()
			
    	/**
    	 * hook into WP's add_meta_boxes action hook
    	 */
    	public function add_meta_boxes()
    	{
    		// Add this metabox to every selected post
    		add_meta_box( 
    			sprintf('postlineadetiempo_%s_section', self::POST_TYPE),
    			"Informacion del evento",
    			array(&$this, 'add_inner_meta_boxes'),
    			self::POST_TYPE
    	    );					
    	} // END public function add_meta_boxes()

		/**
		 * called off of the add meta box
		 */		
		public function add_inner_meta_boxes($post)
		{		
			// Render the job order metabox
			include(sprintf("%s/../templates/%s_metabox.php", dirname(__FILE__), self::POST_TYPE));			
		} // END public function add_inner_meta_boxes($post)

	} // END class Post_Type_Template
} // END if(!class_exists('Post_Type_Template'))
