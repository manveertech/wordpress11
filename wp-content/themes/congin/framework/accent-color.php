<?php
/**
 * Accent color
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start class
if ( ! class_exists( 'Congin_Accent_Color' ) ) {
	class Congin_Accent_Color {
		// Main constructor
		function __construct() {
			add_filter( 'congin_custom_colors_css', array( 'Congin_Accent_Color', 'head_css' ), 999 );
		}

		// Generates the CSS output
		public static function head_css( $output ) {
			// Get custom accent
			$default_accent = '#E33C34';
			$css = $custom_accent = '';

			$custom_accent = strtoupper( congin_get_mod('accent_color', '#E33C34') );
			$elementor_accent = false;

			if ( class_exists( '\Elementor\Plugin' ) ) {
				$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
				$colors = $kit->get_settings_for_display( 'custom_colors' );

				foreach( $colors as $key => $arr ) {
					if ( $arr['_id'] == 'congin_accent' ) {
						$custom_accent = strtoupper( $arr['color'] );
						$elementor_accent = true;
					}
				}
			}
			
			if (!$elementor_accent) {
				if ( $default_accent !== $custom_accent ) {
					$css .= 'body { --e-global-color-congin_accent: ' . $custom_accent . ';}';
				}
			}

			// Return CSS
			if ( ! empty( $css ) ) {
				$output .= '/*ACCENT COLOR*/'. $css;
			}
		
			// Return output css
			return $output;
		}
	}
}

new Congin_Accent_Color();
