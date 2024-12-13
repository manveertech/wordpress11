<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['congin_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_footer_basic'
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Copyrights, 2023 Company.com',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'congin' ),
				'type' => 'congin_textarea',
				'active_callback' => 'congin_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
				'active_callback'=> 'congin_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'congin' ),
				'active_callback'=> 'congin_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'congin' ),
				'active_callback' => 'congin_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_background_img_style',
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
				'active_callback' => 'congin_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'congin' ),
				'active_callback'=> 'congin_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'line_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Line Color', 'congin' ),
				'active_callback'=> 'congin_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom:before',
				'alter' => 'background-color',
			),
		),
	),
);

