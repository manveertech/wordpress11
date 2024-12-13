<?php
/**
 * Entry Content / Related Post
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! is_single() || ! congin_get_mod( 'blog_single_related', false ) )
    return;

if ( ! has_tag() ) { return; }
$tags = wp_get_post_tags( $post->ID );
$first_tag = $tags[0]->term_id;

$query_args = array(
    'tag__in' => array( $first_tag ),
    'post__not_in' => array( $post->ID ),
    'posts_per_page' => -1
);

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) : ?>
    
    <div class="related-news">
        <?php if ( congin_get_mod( 'blog_single_related_header', 'Related Articles') ) {
            echo '<h3 class="related-title">' . esc_html( congin_get_mod( 'blog_single_related_header', 'Related Articles') ) . '</h3>';
        } ?>
        
        <div class="related-post">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="post-item">
                    <div class="inner">
                        <?php
                        $the_cat = get_the_category();
                        $category_name = $the_cat[0]->cat_name;
                        $category_link = get_category_link( $the_cat[0]->cat_ID );

                        $size = 'congin-post-related';
                        $thumb = get_the_post_thumbnail( get_the_ID(), $size );

                        if ( $thumb ) echo '<div class="thumb-wrap"><a href="' . esc_url( get_permalink() ) . '">'. $thumb .'</a></div>';
                        ?>

                        <h4><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h4>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!-- /.post-related -->
    </div><!-- /.related-news -->

<?php endif; wp_reset_postdata(); ?>



