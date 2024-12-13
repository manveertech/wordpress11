<?php
/**
 * Give Forms setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Give Forms General
$this->sections['congin_give_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_give',
	'settings' => array(
		array(
			'id' => 'congin_give_single_featured_title',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Feature Title', 'congin' ),
			),
		),
		array(
			'id' => 'give_single_featured_title',
			'default' =>  '',
			'control' => array(
				'label' => esc_html__( 'Title', 'congin' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'congin' ),
			),
		),
		array(
			'id' => 'give_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Single Give Forms: Featured Title Background', 'congin' ),
			),
		)
	),
);