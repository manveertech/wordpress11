<?php
/**
 * General setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['congin_Accent_Colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#F3B42C',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_no_elementor_accent_color'
			),
		),
	)
);

// Cursor
$this->sections['congin_cursor'] = array(
	'title' => esc_html__( 'Custom Cursor', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'cursor',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
			),
		),
		// cursor 1
		array(
			'id' => 'congin_cursor1_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Custom 1', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor'
			),
		),
		array(
			'id' => 'congin_cursor1_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor'
			),
		),
		array(
			'id' => 'congin_cursor1_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor'
			),
		),
		array(
			'id' => 'congin_cursor1_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor'
			),
		),
		// cursor 2
		array(
			'id' => 'congin_cursor2_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Custom 2', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'congin_cursor2_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'congin_cursor2_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'congin_cursor2_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_1'
			),
		),
		// cursor 3
		array(
			'id' => 'congin_cursor3_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Custom 3', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_1'
			),
		),
		array(
			'id' => 'congin_cursor3_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_2'
			),
		),
		array(
			'id' => 'congin_cursor3_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_2'
			),
		),
		array(
			'id' => 'congin_cursor3_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_2'
			),
		),
		// cursor 4
		array(
			'id' => 'congin_cursor4_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Custom 4', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_3'
			),
		),
		array(
			'id' => 'congin_cursor4_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_3'
			),
		),
		array(
			'id' => 'congin_cursor4_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_3'
			),
		),
		array(
			'id' => 'congin_cursor4_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_3'
			),
		),
		// cursor 5
		array(
			'id' => 'congin_cursor5_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Custom 5', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_4'
			),
		),
		array(
			'id' => 'congin_cursor5_target',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Target', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_4'
			),
		),
		array(
			'id' => 'congin_cursor5_text',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Text', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_4'
			),
		),
		array(
			'id' => 'congin_cursor5_classes',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Classes', 'congin' ),
				'active_callback' => 'congin_cac_has_cursor_4'
			),
		),
	)
);

// PreLoader
$this->sections['congin_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'' => esc_html__( 'Disable','congin' ),
					'animsition' => esc_html__( 'Enable','congin' ),
				),
			),
		),
		array(
			'id' => 'preloader_style',
			'default' => 'default',
			'control' => array(
				'label' => esc_html__( 'Style', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'default' => esc_html__( 'Default','congin' ),
					'image' => esc_html__( 'Image','congin' ),
				),
			),
		),
		array(
			'id' => 'preload_color_1',
			'default' => '#E33C34',
			'control' => array(
				'label' => esc_html__( 'Color 1', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_preloader_default'
			),
			'inline_css' => array(
				'target' => '.animsition-loading',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preload_color_2',
			'default' => '#F3B42C',
			'control' => array(
				'label' => esc_html__( 'Color 2', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_preloader_default'
			),
			'inline_css' => array(
				'target' => '.animsition-loading:before',
				'alter' => 'border-top-color',
			),
		),
		array(
			'id' => 'preloader_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Preloader Image', 'congin' ),
				'active_callback' => 'congin_cac_preloader_image',
				'type' => 'image',
			),
		),
	)
);

// Header Site
$header_style = array( '1' => esc_html__( 'Basic', 'congin' ) );
$header_special = array( '1' => esc_html__( 'Default', 'congin' ) );
$header_fixed = array( '1' => esc_html__( 'None', 'congin' ));
$args = array(  
    'post_type' => 'header',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$header_style[get_the_id()] = get_the_title();
	$header_special[get_the_id()] = get_the_title();
	$header_fixed[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['congin_header_site'] = array(
	'title' => esc_html__( 'Header', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'congin' ),
				'type' => 'select',
				'choices' => $header_style,
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'congin' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Fixed', 'congin' ),
				'type' => 'select',
				'choices' => $header_fixed,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'congin_header_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Header for special page', 'congin' ),
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_blog',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Blog', 'congin' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_blog_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Blog Single', 'congin' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_shop',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Shop', 'congin' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_product_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Product Single', 'congin' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_project_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Project Single', 'congin' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
		array(
			'id' => 'header_service_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Header Service Single', 'congin' ),
				'type' => 'select',
				'choices' => $header_special,
				'active_callback' => 'congin_cac_header_elementor_builder'
			),
		),
	),
);

// Footer
$footer_style = array( '1' => esc_html__( 'Basic', 'congin' ) );
$footer_special = array( '1' => esc_html__( 'Default', 'congin' ) );
$args = array(  
    'post_type' => 'footer',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'ASC'
);

$loop = new WP_Query( $args ); 
while ( $loop->have_posts() ) : $loop->the_post(); 
	$footer_style[get_the_id()] = get_the_title();
	$footer_special[get_the_id()] = get_the_title();
endwhile;
wp_reset_postdata();

$this->sections['congin_footer_site'] = array(
	'title' => esc_html__( 'Footer', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'footer_site_style',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Style', 'congin' ),
				'type' => 'select',
				'choices' => $footer_style,
				'desc' => esc_html__( 'Footer Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings Elementor when edit.', 'congin' )
			),
		),
		array(
			'id' => 'congin_footer_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Footer for special page', 'congin' ),
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_blog',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Blog', 'congin' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_blog_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Blog Single', 'congin' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_shop',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Shop', 'congin' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_product_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Product Single', 'congin' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_project_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Project Single', 'congin' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
		array(
			'id' => 'footer_service_single',
			'default' => '1',
			'control' => array(
				'label' => esc_html__( 'Footer Service Single', 'congin' ),
				'type' => 'select',
				'choices' => $footer_special,
				'active_callback' => 'congin_cac_footer_elementor_builder'
			),
		),
	),
);

// Scroll to top
$this->sections['congin_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['congin_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'congin' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['congin_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Mobile Logo', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'congin' ),
				'description' => esc_html__( 'Example: 150px', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'congin' ),
				'description' => esc_html__( 'Example: 20px 0px 20px 0px', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Mobile Menu', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'congin' ),
				'description' => esc_html__( 'Example: 40px', 'congin' ),
				'active_callback' => 'congin_cac_header_basic'
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
		array(
			'id' => 'mobile_menu_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo', 'congin' ),
				'active_callback' => 'congin_cac_header_basic',
				'type' => 'image',
			),
		),
		array(
			'id' => 'mobile_menu_logo_width',
			'control' => array(
				'label' => esc_html__( 'Mobile Menu Logo: Width', 'congin' ),
				'type' => 'text',
				'active_callback' => 'congin_cac_header_basic'
			),
		),
		// Featured Title
		array(
			'id' => 'heading_featured_title',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Mobile Featured Title', 'congin' ),
			),
		),
		array(
			'id' => 'mobile_featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#featured-title .inner-wrap, #featured-title.centered .inner-wrap, #featured-title.creative .inner-wrap',
				'alter' => 'padding',
			),
		),
	)
);

// 404 Page
$this->sections['congin_404_page'] = array(
	'title' => esc_html__( '404 Page', 'congin' ),
	'panel' => 'congin_general',
	'settings' => array(
		array(
			'id' => '404_image',
			'default' => '',
			'control' => array(
				'label' => esc_html__( '404 Image', 'congin' ),
				'type' => 'image',
			),
		),
		array(
			'id' => '404_image_max_width',
			'control' => array(
				'label' => esc_html__( '404 Image: Width', 'congin' ),
				'type' => 'text',
			),
		),
	)
);
