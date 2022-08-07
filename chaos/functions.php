<?php
/* Adds page name to classes for page */
/* Modified is_single to is_singular, which targets both single archive and pages */
/* Commented out echo statement, as it was showing up on the page output */
add_filter('body_class','page_class');
function page_class($classes) {
   global $wp_query;
   $page = '';
   $page = $wp_query->query_vars['pagename'];
   // add 'pagename' to the $classes array
   $classes[] = $page;
   // return the $classes array
   return $classes;
}
/* Add category to single post pages */
add_filter('body_class','add_category_to_single');
function add_category_to_single($classes) {
	if (is_singular() ) {
		global $post;
		foreach((get_the_category($post->ID)) as $category) {
			/* echo $category->cat_name . ' '; */
			// add category slug to the $classes array
			$classes[] = 'category-'.$category->slug;
		}
	}
	// return the $classes array
	return $classes;
}
// JS for responsive tables
/**
 * Enqueue a script
 */
function myprefix_enqueue_scripts() {
	wp_register_script('table-resp', get_stylesheet_directory_uri() . '/js/table.js', array() );
    wp_enqueue_script( 'table-resp', get_stylesheet_directory_uri() . '/js/table.js', array(), true );
}
add_action( 'wp_enqueue_scripts', 'myprefix_enqueue_scripts' );
?>