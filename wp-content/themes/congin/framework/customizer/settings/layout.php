<?php
/**
 * Layout setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['congin_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'congin' ),
	'panel' => 'congin_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','congin' ),
					'boxed' => esc_html__( 'Boxed','congin' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'congin' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'congin' ),
				'active_callback' => 'congin_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'congin' ),
				'type' => 'color',
				'active_callback' => 'congin_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'congin' ),
				'type' => 'image',
				'active_callback' => 'congin_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'congin' ),
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
				'active_callback' => 'congin_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['congin_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'congin' ),
	'panel' => 'congin_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'congin' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'congin' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'congin' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings elementor when edit.', 'congin' )
			),
		),
		array(
			'id' => 'custom_page_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Custom Page Layout Position', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'congin' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'congin' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'congin' ),
				),
				'desc' => esc_html__( 'Specify layout for all custom pages.', 'congin' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'congin' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'congin' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'congin' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'congin' )
			),
		),
		array(
			'id' => 'single_project_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Project Layout Position', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'congin' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'congin' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'congin' ),
				),
				'desc' => esc_html__( 'Specify layout for all single project pages.', 'congin' ),
				'active_callback' => 'congin_cac_has_single_project',
			),
		),
		array(
			'id' => 'single_service_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Single Service Layout Position', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'congin' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'congin' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'congin' ),
				),
				'desc' => esc_html__( 'Specify layout for all single service pages.', 'congin' ),
				'active_callback' => 'congin_cac_has_single_service',
			),
		),
		array(
			'id' => 'give_forms_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Give Forms Layout Position', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'congin' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'congin' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'congin' ),
				),
				'desc' => esc_html__( 'Specify layout for all Give Forms.', 'congin' ),
				'active_callback' => 'congin_cac_has_give_forms',
			),
		),
	),
);

// Layout Widths
$this->sections['congin_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'congin' ),
	'panel' => 'congin_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'congin' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'congin' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .congin-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'congin' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'congin' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 28%', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);