<?php
/**
 * Header setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header General
$this->sections['congin_header_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(min-width: 1199px)',
				'target' => '.site-header-inner',
				'alter' => 'padding',
			),
			'sanitize_callback' => 'esc_url',
		),
		array(
			'id' => 'header_class',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Extra Class', 'congin' ),
				'type' => 'text',
				'desc' => esc_html__( 'Additional classes to custom your header.', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
		),
	)
);

// Header Logo
$this->sections['congin_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'congin' ),
				'type' => 'image',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'congin' ),
				'type' => 'text',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
	)
);

// Header Menu
$this->sections['congin_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		// General
		array(
			'id' => 'menu_show_current',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Show current page indicator?', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'menu_link_spacing',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Link Spacing', 'congin' ),
				'description' => esc_html__( 'Example: 20px', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li',
				),
				'alter' => array(
					'padding-left',
					'padding-right',
				),
			),
		),
		array(
			'id' => 'menu_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Menu Height', 'congin' ),
				'description' => esc_html__( 'Example: 100px', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#site-header #main-nav > ul > li > a',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a > span',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav > ul > li > a:hover > span',
				),
				'alter' => 'color',
			),
		),
	)
);

// Search & Cart
$this->sections['congin_header_search_cart'] = array(
	'title' => esc_html__( 'Search & Cart', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Search Icon', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Cart Icon', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_header_cart_icon',
			),
		),
	)
);

// Button
$this->sections['congin_header_button'] = array(
	'title' => esc_html__( 'Button', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		array(
			'id' => 'header_button_text',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Text', 'congin' ),
				'type' => 'text',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'header_button_url',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Url', 'congin' ),
				'type' => 'text',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
	),
);

// Header Info
$this->sections['congin_header_info'] = array(
	'title' => esc_html__( 'Header Information', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		// Content
		array(
			'id' => 'header_info_phone',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Phone', 'congin' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'header_info_email',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Email', 'congin' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'congin_cac_header_basic'
			),
		),	
		array(
			'id' => 'header_info_address',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Address', 'congin' ),
				'type' => 'text',
				'rows' => 3,
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		// Style
		array(
			'id' => 'header_info_icon_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Info Icon Color', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => '.header-info .content:before',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'header_info_color',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Info Text Color', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => '.header-info .content',
				'alter' => 'color',
			),
		),
	),
);

// Top Bar Socials
$this->sections['congin_header_socials'] = array(
	'title' => esc_html__( 'Social', 'congin' ),
	'panel' => 'congin_header',
	'settings' => array(
		array(
			'id' => 'header_socials',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'header_socials_spacing',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Socials Spacing', 'congin' ),
				'description' => esc_html__( 'Gap Between Each Social. Example: 10px.', 'congin' ),
				'type' => 'text',
				'active_callback' => 'congin_cac_has_header_socials',
			),
		),
	),
);

// Social settings
$social_options = congin_header_social_options();
foreach ( $social_options as $key => $val ) {
	$this->sections['congin_header_socials']['settings'][] = array(
		'id' => 'header_social_profiles[' . $key .']',
		'control' => array(
			'label' => $val['label'],
			'type' => 'text',
			'active_callback' => 'congin_cac_has_header_socials',
		),
	);
}

// Remove var from memory
unset( $social_options );
