<?php
/**
 * Header / Button
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get defaults from Customizer
$text = congin_get_mod( 'header_button_text', '' );
$url = congin_get_mod( 'header_button_url', '' );

if ( $text && $url ) : ?>
	<div class="header-button">
	    <?php
	    if ( $text && $url ) : ?>
	        <a class="button" href="<?php echo esc_url( do_shortcode( $url ) ); ?>">
	            <?php echo do_shortcode( $text ); ?>
	        </a>
	    <?php endif; ?>
	</div><!-- /.header-info -->
<?php endif; ?>