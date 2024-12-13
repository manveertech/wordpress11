<?php
/**
 * Featured Title setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['congin_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'congin' ),
					'centered' => esc_html__( 'Centered', 'congin' ),
				),
				'active_callback' => 'congin_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'congin' ),
				'description' => esc_html__( 'Example: 250px 0px 150px 0px', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '#featured-title .inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'congin' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'congin' ),
					'cover'        => esc_html__( 'Cover', 'congin' ),
					'center-top'        => esc_html__( 'Center Top', 'congin' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'congin' ),
					'fixed'        => esc_html__( 'Fixed Center', 'congin' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'congin' ),
					'repeat'       => esc_html__( 'Repeat', 'congin' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'congin' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'congin' ),
				),
				'active_callback' => 'congin_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Headings
$this->sections['congin_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Headings', 'congin' ),
	'panel' => 'congin_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 30px.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['congin_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'congin' ),
	'panel' => 'congin_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'portfolio_page',
			'control' => array(
				'label'  => esc_html__( 'Projects Parent Page', 'congin' ),
				'type' => 'select',
				'choices' => congin_get_pages(),
				'active_callback' => 'congin_cac_has_single_project',
			),
		),
		array(
			'id' => 'service_page',
			'control' => array(
				'label'  => esc_html__( 'Services Parent Page', 'congin' ),
				'type' => 'select',
				'choices' => congin_get_pages(),
				'active_callback' => 'congin_cac_has_single_service',
			),
		),
	),
);