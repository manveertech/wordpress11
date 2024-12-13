<?php
/**
 * Wp Event Manager
 *
 * @package congin
 * @version 3.8.9
 */

add_action( 'init', 'congin_add_event_excerpt' );
function congin_add_event_excerpt() {
     add_post_type_support( 'event_listing', 'excerpt' ); 
}

// Archive template
add_filter( 'archive_template', 'congin_event_archive', 20 );
function congin_event_archive($template) {
	if ( is_tax( 'event_listing_category' ) ) {
		$template = get_template_directory() . '/wp-event-manager/content-event_listing_category.php';
	} elseif ( is_tax( 'event_listing_type' ) ) {
		$template = get_template_directory() . '/wp-event-manager/content-event_listing_type.php';
	}
	 
	return $template;
}