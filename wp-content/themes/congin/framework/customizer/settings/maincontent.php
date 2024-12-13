<?php
/**
 * Main Content setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Content General
$this->sections['congin_maincontent_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_maincontent',
	'settings' => array(
		array(
			'id' => 'main_content_top_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'congin' ),
				'description' => esc_html__( 'Example: 30px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'main_content_bottom_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'congin' ),
				'description' => esc_html__( 'Example: 30px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#main-content, .footer-has-subs #main-content',
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'main_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'main_content_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'congin' ),
			),
		),
		array(
			'id' => 'main_content_background_img_style',
			'default' => '',
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
			),
		),
	),
);

// Main Content Left
$this->sections['congin_maincontent_left'] = array(
	'title' => esc_html__( 'Content', 'congin' ),
	'panel' => 'congin_maincontent',
	'settings' => array(
		array(
			'id' => 'left_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'left_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'left_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'left_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-color',
			),
		),
	),
);

// Main Content Right
$this->sections['congin_maincontent_right'] = array(
	'title' => esc_html__( 'Sidebar', 'congin' ),
	'panel' => 'congin_maincontent',
	'settings' => array(
		array(
			'id' => 'right_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'right_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'right_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 3px 3px 0px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'right_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'border-color',
			),
		),
	),
);