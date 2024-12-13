<?php
/**
 * Entry Content / Tags
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( !(is_singular('post') && congin_get_mod( 'blog_single_tags', true )) )
	return;

if ( congin_get_mod( 'blog_single_social_share', false ) )
	echo '<div class="congin-socials-share single-post">';

$text = congin_get_mod( 'blog_single_tags_text', 'Tags' );
if ($text) {
    the_tags( '<div class="post-tags clearfix"><div class="inner"><span class="tag-text">'. esc_html( $text ) . '</span>','','</div></div>' );
} else {
    the_tags( '<div class="post-tags clearfix"><div class="inner">','','</div></div>' );
}

if ( congin_get_mod( 'blog_single_social_share', false ) && class_exists('\WP_Social') )
	echo do_shortcode('[xs_social_share]') . '</div>';
