<?php
/**
 * Cursor
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( !congin_get_mod( 'cursor', false ) ) return false;

$config = array();
$data = '';

if ( '' !== congin_get_mod( 'congin_cursor1_target', '' ) ) {
	$config['efx'][0]['target'] = congin_get_mod( 'congin_cursor1_target', '' );
	$config['efx'][0]['text'] = congin_get_mod( 'congin_cursor1_text', '' );
	$config['efx'][0]['classes'] = congin_get_mod( 'congin_cursor1_classes', '' );
};

if ( '' !== congin_get_mod( 'congin_cursor2_target', '' ) ) {
	$config['efx'][1]['target'] = congin_get_mod( 'congin_cursor2_target', '' );
	$config['efx'][1]['text'] = congin_get_mod( 'congin_cursor2_text', '' );
	$config['efx'][1]['classes'] = congin_get_mod( 'congin_cursor2_classes', '' );
};

if ( '' !== congin_get_mod( 'congin_cursor3_target', '' ) ) {
	$config['efx'][2]['target'] = congin_get_mod( 'congin_cursor3_target', '' );
	$config['efx'][2]['text'] = congin_get_mod( 'congin_cursor3_text', '' );
	$config['efx'][2]['classes'] = congin_get_mod( 'congin_cursor3_classes', '' );
};

if ( '' !== congin_get_mod( 'congin_cursor4_target', '' ) ) {
	$config['efx'][3]['target'] = congin_get_mod( 'congin_cursor4_target', '' );
	$config['efx'][3]['text'] = congin_get_mod( 'congin_cursor4_text', '' );
	$config['efx'][3]['classes'] = congin_get_mod( 'congin_cursor4_classes', '' );
};

if ( '' !== congin_get_mod( 'congin_cursor5_target', '' ) ) {
	$config['efx'][4]['target'] = congin_get_mod( 'congin_cursor5_target', '' );
	$config['efx'][4]['text'] = congin_get_mod( 'congin_cursor5_text', '' );
	$config['efx'][4]['classes'] = congin_get_mod( 'congin_cursor5_classes', '' );
};

$data = 'data-config=\'' . json_encode( $config ) . '\'';
?>
<div class="congin-cursor" <?php echo esc_attr($data); ?>>
    <div class="inner">
      	<span class="text"></span>
      	<svg class="arrow arrow-left" width="10" height="14" viewBox="0 0 10 14" xmlns="http://www.w3.org/2000/svg">
			<path d="M10 9.53674e-07L10 14L-3.41715e-07 7L10 9.53674e-07Z" />
		</svg>
      	<svg class="arrow arrow-right" width="10" height="14" viewBox="0 0 10 14"  xmlns="http://www.w3.org/2000/svg">
			<path d="M0 14V0L10 7L0 14Z" />
		</svg>
    </div>
</div>