<?php get_header(); ?>

<div id="content-wrap" class="congin-container">
    <div id="site-content" class="site-content clearfix">
    	<div id="inner-content" class="inner-content-wrap">
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'page-content' ); ?>>
				<?php
				the_content();
				
				wp_link_pages( array(
					'before'      => '<p class="page-links">'. esc_html__( 'Pages:', 'congin' ),
					'after'       => '</p>',
					'link_before' => '<span>',
					'link_after'  => '</span>'
				) );

				?>
			</article>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( ( is_single() || is_page() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
				comments_template();
			} 
			?>
		<?php endwhile; ?>
		</div>
    </div><!-- /#site-content -->

    <?php get_sidebar(); ?>
</div><!-- /#content-wrap -->

<?php get_footer(); ?>
