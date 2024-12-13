<?php
/**
 * Entry Content / Author
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if it is single post and not defined
if ( is_single() && ! get_the_author_meta( 'description' ) )
	return;
?>

<div class="post-author cleafix">
    <div class="author-avatar">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'congin_author_bio_avatar_size', 160 ) ); ?>
        </a>
    </div>

    <div class="author-desc">
        <h4 class="name"><?php the_author_meta( 'nickname' ); ?></h4>
        <p><?php the_author_meta( 'description' ); ?></p>

        <?php if ( get_the_author_meta( 'user_facebook' ) || get_the_author_meta( 'user_twitter' ) || get_the_author_meta( 'user_google_plus' )  || get_the_author_meta( 'user_linkedin' ) || get_the_author_meta( 'user_pinterest' ) || get_the_author_meta( 'user_instagram' )  ) : ?>
        <div class="author-socials">
            <div class="socials">
                <?php if ( $url = get_the_author_meta( 'user_facebook' ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Facebook', 'congin' ); ?>">
                        <i class="fa fa-facebook-f"></i>
                    </a>
                <?php endif; ?>

                <?php if ( $url = get_the_author_meta( 'user_twitter' ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Twitter', 'congin' ); ?>">
                        <i class="fa fa-twitter"></i>
                    </a>
                <?php endif; ?>

                <?php if ( $url = get_the_author_meta( 'user_google_plus' ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Google +', 'congin' ); ?>">
                        <i class="fa fa-google-plus-g"></i>
                    </a>
                <?php endif; ?>

                <?php if ( $url = get_the_author_meta( 'user_linkedin' ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Linkedin', 'congin' ); ?>">
                        <i class="fa fa-linkedin"></i>
                    </a>
                <?php endif; ?>

                <?php if ( $url = get_the_author_meta( 'user_pinterest' ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Pinterest', 'congin' ); ?>">
                        <i class="fa fa-pinterest"></i>
                    </a>
                <?php endif; ?>

                <?php if ( $url = get_the_author_meta( 'user_instagram' ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Instagram', 'congin' ); ?>">
                        <i class="fa fa-instagram"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>




