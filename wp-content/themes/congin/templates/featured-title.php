<?php
/**
 * Featured Title
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer or Metabox 
if ( ! congin_get_mod( 'featured_title', true ) )
    return;

if ( (congin_get_elementor_option( 'hide_featured_title') == 'none') && !is_search() )
    return;

// Output class based on style
$cls = 'clearfix';

$style = congin_get_mod( 'featured_title_style', 'simple' );

if ( $style ) $cls .= ' '. $style;

// Get default title for all pages
$title = congin_get_mod( 'blog_featured_title', 'Our Blog' );

// Override title for specify pages
if ( is_singular() ) {
    $title = get_the_title();
} elseif ( is_search() ) {
    $title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'congin' ), get_search_query() );
} elseif ( is_404() ) {
    $title = esc_html__( 'Not Found', 'congin' );
} elseif ( is_author() ) {
    the_post();
    $title = sprintf( esc_html__( 'Author Archives: %s', 'congin' ), get_the_author() );
    rewind_posts();
} elseif ( is_day() ) {
    $title = sprintf( esc_html__( 'Daily Archives: %s', 'congin' ), get_the_date() );
} elseif ( is_month() ) {
    $title = sprintf( esc_html__( 'Monthly Archives: %s', 'congin' ), get_the_date( 'F Y' ) );
} elseif ( is_year() ) {
    $title = sprintf( esc_html__( 'Yearly Archives: %s', 'congin' ), get_the_date( 'Y' ) );
} elseif ( is_tax() || is_category() || is_tag() ) {
    $title = single_term_title( '', false );
}

// For shop page
if ( congin_is_woocommerce_shop() ) {
    $title = congin_get_mod( 'shop_featured_title', 'Our Shop' );
}

// For single shop page
if ( is_singular( 'product' ) ) {
    $sst = congin_get_mod( 'shop_single_featured_title', 'Our Shop' );
    if ( $sst != '' ) { $title = $sst; }
    else { $title = get_the_title(); }
}

// For single project
if ( is_singular( 'project' ) ) {
    $title = congin_get_mod( 'project_single_featured_title', '' );
    if ( !$title ) $title = get_the_title();
}

// For single service
if ( is_singular( 'service' ) ) {
    $title = congin_get_mod( 'service_single_featured_title', '' );
    if ( !$title ) $title = get_the_title();
}

// For single post
if ( is_singular( 'post' ) ) {
    $title = congin_get_mod( 'blog_single_featured_title', '' );
    if ( !$title ) $title = get_the_title();
} ?>

<div id="featured-title" class="<?php echo esc_attr( $cls ); ?>" style="<?php echo congin_featured_title_bg(); ?>">
    <div class="congin-container clearfix">
        <div class="inner-wrap">
            <?php if ( congin_get_mod( 'featured_title_heading', false ) ) : ?>
                <div class="title-group">
                    <h1 class="main-title">
                        <?php 
                            if ( congin_get_elementor_option('custom_featured_title') ) {
                                echo esc_html(congin_get_elementor_option('custom_featured_title'));
                            } else {
                                echo do_shortcode( $title ); 
                            }
                        ?>
                    </h1>
                </div>
            <?php endif; ?>
            
            <?php if ( congin_get_mod( 'featured_title_breadcrumbs', true ) ) : ?>
                <div id="breadcrumbs">
                    <div class="breadcrumbs-inner">
                        <div class="breadcrumb-trail">
                            <?php congin_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div><!-- /#featured-title -->

