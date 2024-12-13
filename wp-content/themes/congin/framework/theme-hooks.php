<?php
// Custom classes to body tag
function congin_body_classes() {
	$classes[] = '';

	// Elementor
	if ( class_exists( '\Elementor\Plugin' ) ) {
		if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$classes[] = 'elementor-preview';
		}
	}
	
	if ( get_post_type() == 'elementor_library' )
		$classes[] = 'elementor-template';

	// Get layout position
	$classes[] = congin_layout_position();
	$layout_position = congin_layout_position();
	if ( ! is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-blog' ) )
		$classes[] = 'blog-empty-widget';

	if ( is_page() && $layout_position != 'no-sidebar' && ! is_active_sidebar( 'sidebar-page' ) )
		$classes[] = 'page-empty-widget';

	// Get layout style
	$layout_style = congin_get_mod( 'site_layout_style', 'full-width' );
	$classes[] = 'site-layout-'. $layout_style;


	if ( is_page() ) $classes[] = 'is-page';

	if ( is_page_template( 'templates/page-onepage.php' ) )
		$classes[] = 'one-page';

	// Add classes for Woo pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( congin_is_woocommerce_page() )
			$classes[] = 'woocommerce-page';

		if ( is_account_page() )
			$classes[] = 'woocommerce-account';

		if ( congin_is_woocommerce_shop() )
			$classes[] = 'main-shop-page';

		if ( congin_is_woocommerce_shop() || congin_is_woocommerce_archive_product() ) {
			$shop_cols = congin_get_mod( 'shop_columns', '3' );
			$classes[] = 'shop-col-'. $shop_cols;
		}
	}

	// Add class for search page
	if ( is_search() )
		$classes[] = 'search-page';

	// Boxed Layout dropshadow
	if ( 'boxed' == $layout_style && congin_get_mod( 'site_layout_boxed_shadow' ) )
		$classes[] = 'box-shadow';

	if ( congin_get_mod( 'header_search_icon' ) )
		$classes[] = 'header-simple-search';

	if ( is_singular( 'post' ) )
		$classes[] = 'is-single-post';

	if ( is_singular( 'project' ) )
		$classes[] = 'page-single-project';

	if ( is_singular( 'service' ) )
		$classes[] = 'page-single-service';

	if ( congin_get_mod( 'blog_single_related', false ) )
		$classes[] = 'has-related-post';

	if ( congin_get_mod( 'project_related', false ) )
		$classes[] = 'has-related-project';

	if ( ! is_active_sidebar( 'sidebar-footer-1' ) &&
		! is_active_sidebar( 'sidebar-footer-2' ) &&
		! is_active_sidebar( 'sidebar-footer-3' ) &&
		! is_active_sidebar( 'sidebar-footer-4' ) &&
		! is_active_sidebar( 'sidebar-footer-5' ))
		$classes[] = 'footer-no-widget';

	// CPT pages
	if ( is_singular( 'header' ) )
		$classes[] = 'page-header-single';
	
	if ( is_singular( 'footer' ) )
		$classes[] = 'page-footer-single';

	if ( is_singular( 'give_forms' ) )
		$classes[] = 'page-give-forms';
	
	if ( is_singular( 'event_listing' ) )
		$classes[] = 'single_event_listing';	

	// Hide related product
	$column = congin_get_mod( 'shop_realted_columns', 3 );
	if ($column == 0)
		$classes[] = 'shop-no-related-product';

	// Footer Fixed
	if ( congin_get_elementor_option('footer_fixed') == 'yes' )
		$classes[] = 'footer-fixed';

	// User Log in
	if ( is_user_logged_in() ) 
		$classes[] = 'logged-in';

	// Return classes
	return $classes;
}
add_filter( 'body_class', 'congin_body_classes' );

// Elementor Setup
function congin_get_elementor_option_setup() {
	if ( class_exists( '\Elementor\Plugin' ) ) {
		// Add Congin Color Set
		$congin_color = [
			0 => [
				'_id' 	=> 'congin_primary',
				'title'	=> esc_html__( 'Congin Primary', 'congin' ),
				'color'	=> '#1D2F41'
			],
			1 => [
				'_id'	=> 'congin_text',
				'title'	=> esc_html__( 'Congin Text', 'congin' ),
				'color'	=> '#73787D'
			],
			2 => [
				'_id'	=> 'congin_accent',
				'title'	=> esc_html__( 'Congin Accent', 'congin' ),
				'color'	=> '#FF5B12'
			],
			3 => [
				'_id'	=> 'congin_border',
				'title'	=> esc_html__( 'Congin Border', 'congin' ),
				'color'	=> '#F1F1F1'
			],
			4 => [
				'_id'	=> 'congin_light',
				'title'	=> esc_html__( 'Congin Light', 'congin' ),
				'color'	=> '#F4F5F8'
			],
			5 => [
				'_id'	=> 'congin_dark',
				'title'	=> esc_html__( 'Congin Dark', 'congin' ),
				'color'	=> '#171717'
			]
			
		];

		// Color
		$kit = \Elementor\Plugin::$instance->kits_manager->get_active_kit_for_frontend();
		$colors = $kit->get_settings_for_display( 'custom_colors' );

		$first_time = true;
		
		foreach($congin_color as $arr1) {
			$found = false;
			foreach( $colors as $key => $arr2 ) {
				if ( $arr1['_id'] == $arr2['_id'] ) {
					$found = true;
					$first_time = false;
				}
			}

			if ( !$found ) {
				$colors[] = $arr1;
			}
		}

		if ( $first_time ) {
			// Update Colors
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'custom_colors', $colors);

			// Update Typography
			$idx = 0;
			$typos = $kit->get_settings_for_display( 'system_typography' );
			foreach($typos as $item) {
				switch ( $item['_id'] ) {
					case 'primary':
						$typos[$idx]['typography_font_family'] = 'Roboto';
						$typos[$idx]['typography_font_weight'] = '700';
						break;
					case 'secondary':
						$typos[$idx]['typography_font_family'] = 'Roboto';
						$typos[$idx]['typography_font_weight'] = '700';
						break;
					case 'text':
						$typos[$idx]['typography_font_family'] = 'Roboto';
						$typos[$idx]['typography_font_weight'] = '400';
						break;
					case 'accent':
						$typos[$idx]['typography_font_family'] = 'Roboto';
						$typos[$idx]['typography_font_weight'] = '400';
						break;
					default:
						return;
				}
				$idx++;
			}
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'system_typography', $typos);

			// Update Layout
			$layout = $kit->get_settings_for_display( 'container_width' );
			$layout['size'] = '1200';
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'container_width', $layout);

			// Update Widgets Space
			$widgets_space = $kit->get_settings_for_display( 'space_between_widgets' );
			$widgets_space['size'] = 0;
			$widgets_space['column'] = 0;
			$widgets_space['row'] = 0;
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'space_between_widgets', $widgets_space);

			// Disable Light Box
			$lightbox = $kit->get_settings_for_display( 'global_image_lightbox' );
			$lightbox = 'no';
			\Elementor\Plugin::$instance->kits_manager->update_kit_settings_based_on_option( 'global_image_lightbox', $lightbox);

			// Update Post Support
			$cpt_support = get_option( 'elementor_cpt_support' );
	
			//check if option DOESN'T exist in db
			if( ! $cpt_support ) {
			    $cpt_support = [ 'page', 'post', 'header', 'footer', 'project', 'service', 'event_listing' ]; 
			    update_option( 'elementor_cpt_support', $cpt_support ); 
			}

			// Disable default colors & default fonts
			$disable_default_colors = 'yes';
			$disable_default_fonts = 'yes';
			update_option( 'elementor_disable_color_schemes', $disable_default_colors ); 
			update_option( 'elementor_disable_typography_schemes', $disable_default_fonts ); 

			// Switch Editor Load Method
			update_option( 'elementor_editor_break_lines', 1 ); 
		}
	}
}
add_action( 'after_switch_theme', 'congin_get_elementor_option_setup' );
add_action( 'elementor/init', 'congin_get_elementor_option_setup' );

// Remove products and pages results from the search form widget
function congin_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'product' ) )
		return;

	if ( $query->is_search() ) {
    	$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

	    $post_types_to_remove = array( 'product' );

	    foreach ( $post_types_to_remove as $post_type_to_remove ) {
			if ( is_array( $in_search_post_types ) 
				&& in_array( $post_type_to_remove, $in_search_post_types ) 
			) {
				unset( $in_search_post_types[ $post_type_to_remove ] );
				$query->set( 'post_type', $in_search_post_types );
			}
	    }
	}
}
add_action( 'pre_get_posts', 'congin_custom_search_query' );

// Sets the content width in pixels, based on the theme's design and stylesheet.
function congin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'congin_content_width', 1170 );
}
add_action( 'after_setup_theme', 'congin_content_width', 0 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function congin_widget_tag_cloud_args( $args ) {
	$args['largest'] = 12;
	$args['smallest'] = 12;
	$args['unit'] = 'px';

	return $args;
}
add_filter( 'widget_tag_cloud_args', 'congin_widget_tag_cloud_args' );

// Change default read more style
function congin_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'congin_excerpt_more', 10 );

// Custom excerpt length for posts
function congin_content_length() {
	$length = congin_get_mod( 'blog_excerpt_length', '50' );
	$length = intval( $length );

	if ( ! empty( $length ) || $length != 0 )
		return $length;
}
add_filter( 'excerpt_length', 'congin_content_length', 999 );

// Prevent page scroll when clicking the more link
function congin_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return $link;
}
add_filter( 'the_content_more_link', 'congin_remove_more_link_scroll' );

// Remove read-more link so we can custom it
function congin_remove_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'congin_remove_read_more_link' );

// Custom html categories widget
function cat_count_span( $link ) {
  $link = str_replace( '</a> (', '</a> <span>', $link );
  $link = str_replace( ')', '</span>', $link );
  return $link;
}
add_filter( 'wp_list_categories', 'cat_count_span' );
 

// Remove p in CF7
add_filter('wpcf7_autop_or_not', '__return_false');

// ShopEngine Affiliate 
add_filter('wpmet_author_id', function($id) { return 586; });

