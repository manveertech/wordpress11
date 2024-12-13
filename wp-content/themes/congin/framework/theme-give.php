<?php
/**
 * Give
 *
 * @package congin
 * @version 3.8.9
 */

// Custom Class for container
add_filter( 'give_default_wrapper_start', 'congin_add_class_container' );
function congin_add_class_container() {
	return '<div id="content-wrap" class="give-wrap container congin-container"><div id="site-content" role="main">';
}

// Add sidebar
add_filter( 'give_default_wrapper_end', 'congin_add_sidebar' );
function congin_add_sidebar() {
	ob_start(); ?>
    	</div>
    <?php get_sidebar(); ?>
    </div>  
    <?php 
    $return = ob_get_clean();
	return $return;
}

// Add Featured Image
add_action( 'give_before_single_form_summary', 'give_show_form_images', 15 );

// Move goal progress to featured image
remove_action( 'give_pre_form', 'give_show_goal_progress', 10 );
add_action( 'give_post_featured_thumbnail', 'congin_give_show_goal_progress', 10 );
function congin_give_show_goal_progress() {
	$form_id = get_the_ID();
	$args = get_post_meta($form_id);

	give_get_template(
		'shortcode-goal',
		[
			'form_id' => $form_id,
			'args'    => $args,
		]
	);
	echo apply_filters( 'give_goal_output', ob_get_clean(), $form_id, $args );

	return true;
}

// Show category
add_filter( 'single_give_form_image_html', 'congin_add_category');
function congin_add_category( $images ) {
	$cat = get_the_terms(get_the_ID(), 'give_forms_category');
	if ( is_array($cat) ) {
		if ($cat[0]->slug) {
			$images .= '<a class="cat-item" href="' . esc_url( get_term_link($cat[0]->term_id, 'give_forms_category') ) . '">' . esc_html($cat[0]->name) . '</a>';
		}
	}
	return $images;
}

// Add reveal button
add_action( 'give_payment_mode_top', 'congin_add_reveal_button');
function congin_add_reveal_button() {
	
	$meta = get_post_meta(get_the_ID());
	if ( isset($meta['_give_checkout_label']) ) {
		echo '<button type="button" class="give-btn-reveal">' . $meta['_give_checkout_label'][0] . '</button>';
	}
}

