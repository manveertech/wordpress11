<?php
/**
 * Framework functions
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if Elementor is active
function congin_elementor_activated() {
	return class_exists( '\Elementor\Plugin' );
}

// Get Settings options of elementor
function congin_get_elementor_option( $settings ) {
	if ( !congin_elementor_activated() ) { return false; }

	// Get the current post id
	$post_id = get_the_ID();

	// Get the page settings manager
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

	// Get the settings model for current post
	$page_settings_model = $page_settings_manager->get_model( $post_id );

	return  $page_settings_model->get_settings( $settings );

}

// Check if build with Elementor
function congin_build_with_elementor() {
	if ( congin_elementor_activated() && get_the_ID() ) {
		return Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor();
	} else {
		return false;
	}
}

// Check if has Elementor Widget
function congin_has_elementor_widget() {
	if ( congin_header_style() !== '1' ) return true;

	if ( congin_elementor_activated() && get_the_ID() ) {
		return Elementor\Plugin::$instance->documents->get( get_the_ID() )->is_built_with_elementor();
	} else {
		return false;
	}
}

// Return class for reploader site
function congin_preloader_class() {
	// Get page preloader option from theme mod
	$class = congin_get_mod( 'preloader', 'animsition' );
	$class .= ' ' . congin_get_mod( 'preloader_style', 'default' );
	return esc_attr( $class );
}

// Get layout position for pages
function congin_layout_position() {
	// Default layout position
	$layout = 'sidebar-right';

	// Get layout position for site
	$layout = congin_get_mod( 'site_layout_position', 'sidebar-right' );

	// Get layout position for page blog
	if ( is_page() ) {
		if ( congin_build_with_elementor() ) {
			if ( congin_get_elementor_option('site_layout_position') ) {
				$layout = congin_get_elementor_option('site_layout_position');
			} else {
				$layout = congin_get_mod( 'custom_page_layout_position', 'no-sidebar' );
			}
		} else {
		    $layout = congin_get_mod( 'custom_page_layout_position', 'no-sidebar' );
		}
	}

	// Get layout position for single post
	if ( is_singular( 'post' ) )
		$layout = congin_get_mod( 'single_post_layout_position', 'sidebar-right' );

	// Get layout position for shop pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() || is_product_category() )
			$layout = congin_get_mod( 'shop_layout_position', 'no-sidebar' );  
		if ( is_singular( 'product' ) )
			$layout = congin_get_mod( 'shop_single_layout_position', 'no-sidebar' );
		if ( is_cart() || is_checkout() ) {
			$layout = 'no-sidebar';
		}
	}

	// Other single except single post
	if ( is_single() && !is_singular( 'post' ) ) 
		$layout = 'no-sidebar';

	// Get layout position for single project
	if ( is_singular( 'project' ) )
		$layout = congin_get_mod( 'single_project_layout_position', 'no-sidebar' );

	// Get layout position for single service
	if ( is_singular( 'service' ) )
		$layout = congin_get_mod( 'single_service_layout_position', 'no-sidebar' );

	// Get layout position for give forms
	if ( is_singular( 'give_forms' ) )
		$layout = congin_get_mod( 'give_forms_layout_position', 'sidebar-right' );

	// Elementor settings
	if ( congin_get_elementor_option( 'site_layout_position' ) ) {
		$layout = congin_get_elementor_option( 'site_layout_position' );
	} 

	return $layout;
}

// Theme pagination
function congin_pagination( $query = '', $echo = true ) {
	
	$prev_arrow = '<i class="ci-chevron-left"></i>';
	$next_arrow = '<i class="ci-chevron-right"></i>';

	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	$total  = $query->max_num_pages;
	$big    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => $prev_arrow,
			'next_text' => $next_arrow
		);

		// Output
		if ( $echo ) {
			echo '<div class="congin-pagination clearfix">'. paginate_links( $args ) .'</div>';
		} else {
			return '<div class="congin-pagination clearfix">'. paginate_links( $args ) .'</div>';
		}

	}
}

// Render blog entry blocks
function congin_blog_entry_layout_blocks() {

	// Get layout blocks
	$blocks = congin_get_mod( 'blog_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'meta,title,excerpt_content,readmore';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Set block keys equal to vals
	$blocks = array_combine( $blocks, $blocks );

	// Return blocks
	return $blocks;
}

// Render blog meta items
function congin_entry_meta() {
	// Get meta items from theme mod
	$meta_item = congin_get_mod( 'blog_entry_meta_items', array( 'author', 'comments', 'date', 'categories' ) );

	// If blocks are 100% empty return defaults
	$meta_item = $meta_item ? $meta_item : 'author,comments';

	// Turn into array if string
	if ( $meta_item && ! is_array( $meta_item ) ) {
		$meta_item = explode( ',', $meta_item );
	}

	// Set keys equal to values
	$meta_item = array_combine( $meta_item, $meta_item );

	// Loop through items
	foreach ( $meta_item as $item ) :
		if ( 'author' == $item ) {
			if ( congin_get_mod('blog_meta_style', 'simple') == 'simple' ) {
				printf( '<span class="post-by-author item">%4$s <a class="name" href="%1$s" title="%2$s">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( esc_html__( 'View all posts by %s', 'congin' ), get_the_author() ) ),
					get_the_author(),
					esc_html( congin_get_mod( 'blog_before_author', 'by' ) )
				);
			} else {
				printf( '<span class="post-by-author item">%5$s %4$s <a class="name" href="%1$s" title="%2$s">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( esc_html__( 'View all posts by %s', 'congin' ), get_the_author() ) ),
					get_the_author(),
					esc_html( congin_get_mod( 'blog_before_author', 'by' ) ),
					get_avatar( get_the_author_meta( 'user_email' ), 'thumbnail' )
				);
			}
			
			
		}
		else if ( 'comments' == $item ) {
			if ( comments_open() || get_comments_number() ) {
				echo '<span class="post-comment item"><span class="inner">';
				comments_popup_link( esc_html__( '0 comments', 'congin' ), esc_html__( '1 Comment', 'congin' ), esc_html__( '% Comments', 'congin' ) );
				echo '</span></span>';
			}
		}
		else if ( 'date' == $item ) {
			printf( '<span class="post-date item"><span class="entry-date">%1$s</span></span>',
				get_the_date()
			);
		}
		else if ( 'categories' == $item ) {
			echo '<span class="post-meta-categories item">' . 
				esc_html( congin_get_mod( 'blog_before_category', 'in' ) ) . ' ';
			the_category( ', ', get_the_ID() );
			echo '</span>';
		}
	endforeach;
}

// Return background CSS
function congin_bg_css( $style ) {
	$css = '';
	if ( $style = congin_get_mod( $style ) ) {
		if ( 'fixed' == $style ) {
			$css .= ' background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-top' == $style ) {
			$css .= ' background-position: center top; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-bottom' == $style ) {
			$css .= ' background-position: center bottom; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'cover' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top; background-size: cover;';
		} elseif ( 'center-top' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top;';
		} elseif ( 'repeat' == $style ) {
			$css .= ' background-repeat: repeat;';
		} elseif ( 'repeat-x' == $style ) {
			$css .= ' background-repeat: repeat-x;';
		} elseif ( 'repeat-y' == $style ) {
			$css .= ' background-repeat: repeat-y;';
		}
	}

	return esc_attr( $css );
}

// Return background css for elements
function congin_element_bg_css( $bg ) {
	$css = '';
	$style = $bg .'_style';

	if ( $bg_img = congin_get_mod( $bg ) )
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';

	$css .= congin_bg_css( $style );

	return esc_attr( $css );
}

// Return background css for featured title area
function congin_featured_title_bg() {
	$css = '';
	
	if ( is_page() ) {
		$page_bg_url = '';
		$bg_img = congin_get_mod( 'featured_title_background_img' );
		if ( !$page_bg_url && $bg_img ) {
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
		} else {
			$css .= 'background-image: url('. esc_url( $page_bg_url ) .');';
		}
		
	} elseif ( is_single() && ( $bg_img = congin_get_mod( 'blog_single_featured_title_background_img' ) ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	} elseif ( $bg_img = congin_get_mod( 'featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( congin_is_woocommerce_shop() && $bg_img = congin_get_mod( 'shop_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_singular( 'product' ) && $bg_img = congin_get_mod( 'shop_single_featured_title_background_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	if ( is_tax() || is_singular( 'project' ) ) {
		if ( $bg_img = congin_get_mod( 'project_single_featured_title_background_img' ) )
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}
	
	if ( is_singular( 'service' ) ) {
		if ( $bg_img = congin_get_mod( 'service_single_featured_title_background_img' ) )
			$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= congin_bg_css('featured_title_background_img_style');

	return esc_attr( $css );
}

// Return background for main content area
function congin_main_content_bg() {
	$css = '';

	if ( $bg_img = congin_get_mod( 'main_content_background_img' ) ) {
		$css = 'background-image: url('. esc_url( $bg_img ). ');';
	}

	$css .= congin_bg_css('main_content_background_img_style');

	return esc_attr( $css );
}

add_action( 'after_setup_theme', 'congin_main_content_bg' );

// Return background for footer area
function congin_footer_bg() {
	$css = '';

	if ( $bg_img = congin_get_mod( 'footer_bg_img' ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ) .');';
	}

	$css .= congin_bg_css('footer_bg_img_style');

	return esc_attr( $css );
}

// Returns array of social
function congin_header_social_options() {
	return apply_filters ( 'congin_header_social_options', array(
		'facebook' => array(
			'label' => esc_html__( 'Facebook', 'congin' ),
			'icon_class' => 'ci-facebook-square',
		),
		'twitter' => array(
			'label' => esc_html__( 'Twitter', 'congin' ),
			'icon_class' => 'ci-twitter',
		),
		'instagram'  => array(
			'label' => esc_html__( 'Instagram', 'congin' ),
			'icon_class' => 'ci-instagram',
		),
		'youtube' => array(
			'label' => esc_html__( 'Youtube', 'congin' ),
			'icon_class' => 'ci-youtube',
		),
		'dribbble'  => array(
			'label' => esc_html__( 'Dribbble', 'congin' ),
			'icon_class' => 'ci-dribbble',
		),
		'vimeo' => array(
			'label' => esc_html__( 'Vimeo', 'congin' ),
			'icon_class' => 'ci-vimeo',
		),
		'tumblr'  => array(
			'label' => esc_html__( 'Tumblr', 'congin' ),
			'icon_class' => 'ci-tumblr',
		),
		'pinterest'  => array(
			'label' => esc_html__( 'Pinterest', 'congin' ),
			'icon_class' => 'ci-pinterest',
		),
		'linkedin'  => array(
			'label' => esc_html__( 'LinkedIn', 'congin' ),
			'icon_class' => 'ci-linkedin',
		),
	) );
}

// Check if it is WooCommerce Pages
function congin_is_woocommerce_page() {
    if ( function_exists ( "is_woocommerce" ) && is_woocommerce() )
		return true;

    $woocommerce_keys = array (
    	"woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" );

    foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
			return true ;
		}
    }
    
    return false;
}

// Checks if is WooCommerce Shop page
function congin_is_woocommerce_shop() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_shop() ) {
		return true;
	}
}

// Checks if is WooCommerce archive product page
function congin_is_woocommerce_archive_product() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_product_category() || is_product_tag() ) {
		return true;
	}
}

// Returns correct ID for any object
function congin_parse_obj_id( $id = '', $type = 'page' ) {
	if ( $id && function_exists( 'icl_object_id' ) ) {
		$id = icl_object_id( $id, $type );
	}
	return $id;
}

// Hexdec color string to rgb(a) string
function congin_hex2rgba( $color, $opacity = false ) {
 	$default = 'rgb(0,0,0)';

	if ( empty( $color ) ) return $default; 
    if ( $color[0] == '#' ) $color = substr( $color, 1 );

    if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map( 'hexdec', $hex );

    if ( $opacity ) {
    	if ( abs($opacity ) > 1 ) $opacity = 1.0;
    	$output = 'rgba('. implode( ",", $rgb ) .','. $opacity .')';
    } else {
    	$output = 'rgb('. implode( ",", $rgb ) .')';
    }

    return $output;
}

// Get All Pages
function congin_get_pages() {
	$args = [
        'post_type' => 'page',
        'posts_per_page' => -1,
    ];

    $pages = get_posts($args);
    $options = [];
    $options[] = 'Default';

    if (!empty($pages) && !is_wp_error($pages)) {
        foreach ($pages as $page) {
            $options[$page->ID] = $page->post_title;
        }
    }
    return $options;
}

// Return Footer Style
function congin_header_style() {
	$header_style = '1';

	$header_style = congin_get_mod( 'header_site_style', '1' );

	if ( congin_elementor_activated() ) {
		if ( !is_null(congin_get_elementor_option('header_style') ) && ( congin_get_elementor_option('header_style') !== '0') ) {
	        $header_style = congin_get_elementor_option('header_style');
	    } else {
	    	if ( is_singular( 'post' ) && ( congin_get_mod( 'header_blog_single', '1' ) !== '1' ) ) {
				$header_style = congin_get_mod( 'header_blog_single', '1' );
			} else if ( is_home() && ( congin_get_mod( 'header_blog', '1' ) !== '1' ) ) {
				$header_style = congin_get_mod( 'header_blog', '1' );
			} else if ( congin_is_woocommerce_shop() && ( congin_get_mod( 'header_shop', '1' ) !== '1' ) ) {
				$header_style = congin_get_mod( 'header_shop', '1' );
			} else if ( is_singular( 'product' ) && ( congin_get_mod( 'header_product_single', '1' ) !== '1' ) ) {
				$header_style = congin_get_mod( 'header_product_single', '1' );
			} else if ( is_singular( 'service' ) && ( congin_get_mod( 'header_service_single', '1' ) !== '1' ) ) {
				$header_style = congin_get_mod( 'header_service_single', '1' );
			} else if ( is_singular( 'project' ) && ( congin_get_mod( 'header_project_single', '1' ) !== '1' ) ) {
				$header_style = congin_get_mod( 'header_project_single', '1' );
			}
			
			// Polylang header
			if ( function_exists('pll_current_language') ) {
			    if (pll_get_post( $header_style, pll_current_language() )) {
			        $header_style = pll_get_post( $header_style, pll_current_language() );
			    }
			}
	    }

		if ( is_singular('header') ) {
			$header_style = '1';
		}
	}

	return $header_style;
}

// Return Footer Style
function congin_footer_style() {
	$footer_style = '1';
	if ( congin_elementor_activated() ) {
		$footer_style = congin_get_mod( 'footer_site_style', '1' );

		if (!is_null(congin_get_elementor_option('footer_style')) && (congin_get_elementor_option('footer_style') !== '0')) {
			$footer_style = congin_get_elementor_option('footer_style');
		} else {
			if ( is_singular( 'post' ) && ( congin_get_mod( 'footer_blog_single', '1' ) !== '1' ) ) {
				$footer_style = congin_get_mod( 'footer_blog_single', '1' );
			} else if ( is_home() && ( congin_get_mod( 'footer_blog', '1' ) !== '1' ) ) {
				$footer_style = congin_get_mod( 'footer_blog', '1' );
			} else if ( congin_is_woocommerce_shop() && ( congin_get_mod( 'footer_shop', '1' ) !== '1' ) ) {
				$footer_style = congin_get_mod( 'footer_shop', '1' );
			} else if ( is_singular( 'product' ) && ( congin_get_mod( 'footer_product_single', '1' ) !== '1' ) ) {
				$footer_style = congin_get_mod( 'footer_product_single', '1' );
			} else if ( is_singular( 'service' ) && ( congin_get_mod( 'footer_service_single', '1' ) !== '1' ) ) {
				$footer_style = congin_get_mod( 'footer_service_single', '1' );
			} else if ( is_singular( 'project' ) && ( congin_get_mod( 'footer_project_single', '1' ) !== '1' ) ) {
				$footer_style = congin_get_mod( 'footer_project_single', '1' );
			}
			
			// Polylang footer
			if ( function_exists('pll_current_language') ) {
			    if (pll_get_post( $footer_style, pll_current_language() )) {
			        $footer_style = pll_get_post( $footer_style, pll_current_language() );
			    }
			}
		}

		if (is_singular('footer')) 
			$footer_style = '1';
	} 

	return $footer_style;
}

//Comment Field Order
add_filter( 'comment_form_fields', 'congin_comment_fields_custom_order' );
function congin_comment_fields_custom_order( $fields ) {
    $comment_field = $fields['comment'];
    $author_field = $fields['author'];
    $email_field = $fields['email'];
    unset( $fields['comment'] );
    unset( $fields['author'] );
    unset( $fields['email'] );
    // the order of fields is the order below, change it as needed:
    $fields['author'] = $author_field;
    $fields['email'] = $email_field;
    $fields['comment'] = $comment_field;
    // done ordering, now return the fields:
    return $fields;
}

// 404 Image
function congin_404_image() {
	$html = '';
	$style = '';
	$image_src = congin_get_mod( '404_image' );
	$image_size = congin_get_mod( '404_image_max_width', '' );

	if ( !$image_src ) return '';
	if ( $image_size ) $style .= 'max-width:' . $image_size;

	$html = printf( '<div class="image-404" style="%2$s"><img alt="404" src="%1$s" /></div>', 
		esc_html( $image_src ),
		esc_attr( $style )
	);

	return $html;
}

function congin_replace_url() {
	global $wpdb;
	$from = 'https://tplabs.co/congin';
	$to = get_site_url();

	// @codingStandardsIgnoreStart cannot use `$wpdb->prepare` because it remove's the backslashes
	$rows_affected = $wpdb->query(
		"UPDATE {$wpdb->postmeta} " .
		"SET `meta_value` = REPLACE(`meta_value`, '" . str_replace( '/', '\\\/', esc_url($from) ) . "', '" . str_replace( '/', '\\\/', esc_url($to) ) . "') " .
		"WHERE `meta_key` = '_elementor_data' AND `meta_value` LIKE '[%' ;" ); // meta_value LIKE '[%' are json formatted
	// @codingStandardsIgnoreEnd
}