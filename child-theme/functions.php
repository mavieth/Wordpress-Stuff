<?php
/*
 * Custom function to load styles and scripts
 */


/*
 * Load Base Child Styles
 */
function load_css() {
		wp_register_style( 'child-style', get_stylesheet_directory_uri() . '/styles/css/child-style.css');
		wp_enqueue_style( 'child-style' );		

		wp_register_style( 'reset', get_stylesheet_directory_uri() . '/styles/css/reset.css');
		wp_enqueue_style( 'reset' );		

		if(is_page_template("page-timeline.php")){
			wp_register_style( 'timeline-style', get_stylesheet_directory_uri() . '/styles/css/timeline-style.css');
			wp_enqueue_style( 'timeline-style' );				
		}


}


/*
 * Load Child Scripts
 */
function load_js() {
	wp_enqueue_script(
		'child-script',
		get_template_directory_uri() . '../../hueman-child/js/child-script.js'
	);

	if(is_page_template("page-timeline.php")){
		wp_enqueue_script(
			'timeline-script',
			get_template_directory_uri() . '../../hueman-child/js/timeline-script.js'
		);	
		
		wp_enqueue_script(
			'modernizr',
			get_template_directory_uri() . '../../hueman-child/js/modernizr.js'
		);		
	}
}
add_action( 'wp_enqueue_scripts', 'load_css' );
add_action( 'wp_enqueue_scripts', 'load_js' );


/*
 * JQUERY
 */
if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);
function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

/*
 * Custom Post Type for
 */
if ( ! function_exists('timeline_post_type') ) {
function timeline_post_type() {

	$labels = array(
		'name'                => _x( 'Timline Events', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Timeline', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Timeline', 'text_domain' ),
		'name_admin_bar'      => __( 'Timeline Post', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Event:', 'text_domain' ),
		'all_items'           => __( 'All Events', 'text_domain' ),
		'add_new_item'        => __( 'Add New Event', 'text_domain' ),
		'add_new'             => __( 'Add New Event', 'text_domain' ), //wp-admin sidebar
		'new_item'            => __( 'New Event', 'text_domain' ),
		'edit_item'           => __( 'Edit Event', 'text_domain' ),
		'update_item'         => __( 'Update Event', 'text_domain' ),
		'view_item'           => __( 'View Produdct', 'text_domain' ),
		'search_items'        => __( 'Search events', 'text_domain' ),
		'not_found'           => __( 'No events found', 'text_domain' ),
		'not_found_in_trash'  => __( 'No events found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'timeline_key', 'text_domain' ),
		'description'         => __( 'Add timeline posts', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-calendar-alt',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'timeline_key', $args );

}
// Hook into the 'init' action
add_action( 'init', 'timeline_post_type', 0 );

}







