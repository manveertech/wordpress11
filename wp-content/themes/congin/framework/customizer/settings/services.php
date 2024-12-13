<?php
/**
 * Services setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Service General
$this->sections['congin_services_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_services',
	'settings' => array(
		array(
			'id' => 'congin_service_single_featured_title',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Feature Title', 'congin' ),
			),
		),
		array(
			'id' => 'service_single_featured_title',
			'default' =>  '',
			'control' => array(
				'label' => esc_html__( 'Title', 'congin' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'congin' ),
			),
		),
		array(
			'id' => 'service_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Service: Featured Title Background', 'congin' ),
			),
		)
	),
);