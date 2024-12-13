<?php

// Sets up theme defaults and registers support for various WordPress features.
function congin_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'congin', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Make Embed Responsive
	add_theme_support( 'responsive-embeds' );

	// Custom background color.
	add_theme_support( 'custom-background' );

	// Custom Header
	add_theme_support( 'custom-header' );

	// Enable woocommerce support
	add_theme_support( 'woocommerce' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'congin-post-standard', 1170, 650, true );
	add_image_size( 'congin-post-thumbnail', 60, 60, true );

	// Register menus
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'congin' ) );
	
	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video'
	) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css' ) );

}
add_action( 'after_setup_theme', 'congin_theme_setup' );

// Enqueues scripts and styles.
function congin_theme_scripts() {
	// Core style & script for theme
	wp_enqueue_style( 'animsition', get_template_directory_uri() . '/assets/css/animsition.css', array(), '4.0.1' );

	wp_enqueue_script( 'animsition', get_template_directory_uri() . '/assets/js/animsition.js', array('jquery'), '4.0.1', true );
	wp_enqueue_style( 'elementor-icons-core', get_template_directory_uri() . '/assets/css/core-icons.css', array(), '1.0.0' );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/easing.js', array('jquery'), '1.3.0', true );
	wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/assets/js/fitvids.js', array('jquery'), '1.0.0', true );

	// Theme Style
	wp_enqueue_style( 'congin-theme-style', get_stylesheet_uri(), array(), '1.0' );
	wp_add_inline_style( 'congin-theme-style', apply_filters( 'congin_custom_colors_css', null ) );

	// Theme Script
	wp_enqueue_script( 'congin-theme-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '1.0', true );

	// Carousel
	$post_format = get_post_format();
	if ( (is_single() && ( 'post-gallery' == $post_format )) ||
		(is_singular('post') && congin_get_mod( 'blog_single_related', false )) ||
		(is_singular('project') && congin_get_mod( 'project_related', false )) ) {
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css', array(), '1.0.0' );
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick.js', array('jquery'), '1.0.0', true );
		wp_enqueue_script( 'congin-slide', get_template_directory_uri() . '/assets/js/slide.js', array('jquery'), '1.0.0', true );
	}

	// Woocommerce
    if ( class_exists( 'woocommerce' ) ) {
    	wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), '1.0' );
    }

	// Comment JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Custom Cursor
	if ( congin_get_mod( 'cursor', false ) ) {
		wp_enqueue_script( 'gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array( 'jquery' ), '1.0.0', true );
		wp_enqueue_script( 'cursor', get_template_directory_uri() . '/assets/js/cursor.js', array('jquery'), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'congin_theme_scripts' );

// Registers a widget areas.
function congin_sidebars_init() {
	// Sidebar for Blog
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Blog', 'congin' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in Sidebar Blog.', 'congin' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>'
	) );

	// Sidebar for Pages
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar Page', 'congin' ),
		'id'			=> 'sidebar-page',
		'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Page', 'congin' ),
		'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h2 class="widget-title"><span>',
		'after_title'	=> '</span></h2>'
	) );

	if ( post_type_exists('project') ) {
		// Sidebar for Portfolio
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Portfolio', 'congin' ),
			'id'			=> 'sidebar-portfolio',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Portfolio', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
	}

	// Sidebar for Services
	if ( post_type_exists('service') ) {
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Service', 'congin' ),
			'id'			=> 'sidebar-service',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Service', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
	}

	// Sidebar for Shop
	if ( class_exists( 'woocommerce' ) ) {
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Shop', 'congin' ),
			'id'			=> 'sidebar-shop',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Shop', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
	}

	// Sidebar for Cause
	if (class_exists('Give')) {
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Cause', 'congin' ),
			'id'			=> 'sidebar-give',
			'description'	=> esc_html__( 'Add widgets here to appear in Cause Single Sidebar', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
	}

	// 4 Sidebars for Footer
	if ( congin_footer_style() == '1' ) {
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Footer 1', 'congin' ),
			'id'			=> 'sidebar-footer-1',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 1', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Footer 2', 'congin' ),
			'id'			=> 'sidebar-footer-2',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 2', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Footer 3', 'congin' ),
			'id'			=> 'sidebar-footer-3',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 3', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
		register_sidebar( array(
			'name'			=> esc_html__( 'Sidebar Footer 4', 'congin' ),
			'id'			=> 'sidebar-footer-4',
			'description'	=> esc_html__( 'Add widgets here to appear in Sidebar Footer 4', 'congin' ),
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widget-title"><span>',
			'after_title'	=> '</span></h2>'
		) );
	}
	
}
add_action( 'widgets_init', 'congin_sidebars_init' );

// Include required files.
require( get_template_directory() . '/framework/get-mods.php' );
require( get_template_directory() . '/framework/theme-hooks.php' );
require( get_template_directory() . '/framework/theme-functions.php' );
require( get_template_directory() . '/framework/theme-admin.php' );
require( get_template_directory() . '/framework/fonts.php' );
require( get_template_directory() . '/framework/typography.php' );
require( get_template_directory() . '/framework/accent-color.php' );
require( get_template_directory() . '/framework/customizer/customizer.php' );
require( get_template_directory() . '/framework/elementor-options.php' );
require( get_template_directory() . '/framework/widget-areas.php' );
require( get_template_directory() . '/framework/breadcrumbs.php' );
require( get_template_directory() . '/framework/plugins.php' );
require( get_template_directory() . '/framework/theme-woocommerce.php' );
require( get_template_directory() . '/framework/theme-give.php' );
require( get_template_directory() . '/framework/theme-wp-event-manager.php' );
require( get_template_directory() . '/framework/demo-install.php' );

// Update checker
require( get_template_directory() . '/framework/update-checker/plugin-update-checker.php');
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$settings = get_option('congin_activate_settings');
$code = isset($settings['congin_code_purchase']) ? $settings['congin_code_purchase'] : '';;
$site_url = parse_url(get_home_url());
$web = $site_url['host'];

$url = 'https://tplabs.co/api/checkUpdate?theme=congin&code=' . $code . '&web=' . $web;

$MAEUpdateChecker = PucFactory::buildUpdateChecker(
	$url,
	get_template_directory() . '/functions.php', 
	'congin'
);

