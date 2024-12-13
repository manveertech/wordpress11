<?php
/**
 * Entry Content / Meta
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( is_single() && ! congin_get_mod( 'blog_single_meta', true ) )
	return;

// Exit if build event with Elementor
if ( congin_get_elementor_option('event_builder') == 'yes' )
	return;
?>

<div class="post-meta <?php echo esc_attr( congin_get_mod('blog_meta_style', 'simple') ); ?>">
	<div class="post-meta-content">
		<div class="post-meta-content-inner clearfix">
			<?php congin_entry_meta(); ?>
		</div>
	</div>
</div>



