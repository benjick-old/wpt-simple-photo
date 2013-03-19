<?php

require_once('lib/post-portfolio.php');
require_once('lib/loads.php');

// BEGIN: if you are logged into the admin area, show what template someone is using on the top of all pages
	if (is_user_logged_in()) { add_action('wp_footer', 'show_template'); }

	function show_template() {
		global $template;
		print_r($template);
		//global $wp_taxonomies;
		//print_r($wp_taxonomies['sections']);
	}

// Removes tags generated in the WordPress Head that we don't use, you could read up and re-enable them if you think they're needed
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');

$args = array(
    'flex-width'    => false,
    'width'         => 280,
    'flex-height'    => true,
    'height'        => 200,
    'default-image' => get_template_directory_uri() . '/images/header.png',
);
add_theme_support( 'custom-header', $args );


// Loads jQuery from the Google CDN, loading jquery this way ensures it won't be included twice with plugins that include it
/*
if you are developing this site locally you can use wordpress' local copy of jquery by commenting out the deregister line and the line with google's version of jquery below and registering the local copy
like this:
           // wp_deregister_script( 'jquery' );
           // wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
           wp_register_script ( 'jquery' );
           wp_enqueue_script( 'jquery' );
*/

	function my_init_method() {
	    if (!is_admin()) {
	        wp_deregister_script( 'jquery' );
	        wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js');
	        wp_enqueue_script( 'jquery' );
	    }
	} 
	add_action('init', 'my_init_method');


// Activates menu features
	if (function_exists('add_theme_support')) {
	    add_theme_support('menus');
	}


// Activates Featured Image function
	add_theme_support( 'post-thumbnails' );


// Removes the automatic paragraph tags from the excerpt, we leave it on for the content and have a custom field you can use to turn it off on a page by page basis --> wpautop = false
	remove_filter('the_excerpt', 'wpautop');

// Used to create custom length excerpts
function get_the_custom_excerpt($length){
	return substr( get_the_excerpt(), 0, strrpos( substr( get_the_excerpt(), 0, $length), ' ' ) ).'...';
}

// Register wigetized sidebars, changing the default output from lists to divs

    if ( function_exists('register_sidebar') )

    register_sidebar(array(
        'id' => 'sidebar-main',
        'name' => 'Sidebar: Main',
        'description' => 'The second (secondary) sidebar.',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));
    
    // // if you want to add more just keep adding them like this:
    register_sidebar(array(
        'id' => 'sidebar-menu',
        'name' => 'Sidebar: Menu',
        'description' => 'Menu',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widgettitle">',
        'after_title' => '</h4>',
    ));



// This function is used to get the slug of the page
	function get_the_slug() {
		global $post;
		if ( is_single() || is_page() ) {
			return $post->post_name;
		} else {
			return "";
		}
	}
	

?>