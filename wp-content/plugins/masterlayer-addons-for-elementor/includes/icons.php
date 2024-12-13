<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


add_filter( 'elementor/icons_manager/additional_tabs', 'mae_iconpicker_register' );

function mae_iconpicker_register( $icons = array() ) {

	$icons['core'] = array(
		'name'          => 'core',
		'label'         => esc_html__( 'Core Icons', 'masterlayer' ),
		'labelIcon'     => 'ci-like',
		'prefix'        => 'ci-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/core-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/core-icons/core-icons.json',
		'ver'           => '1.0.0',
	);

	$icons['congin'] = array(
		'name'          => 'congin',
		'label'         => esc_html__( 'Congin Icons', 'masterlayer' ),
		'labelIcon'     => 'cg-architect',
		'prefix'        => 'cg-',
		'displayPrefix' => '',
		'url'           => MAE_URL . 'assets/css/congin-icons.css',
		'fetchJson'     => MAE_URL . 'assets/fonts/congin-icons/congin-icons.json',
		'ver'           => '1.0.0',
	);

	return $icons;
}
