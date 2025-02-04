<?php
/**
 * Pagination - Show numbered pagination for the [events] shortcode
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( $max_num_pages <= 1 ) {
	return;
}

// Calculate pages to output 
$end_size    = 3;
$mid_size    = 3;
$start_pages = range( 1, $end_size );
$end_pages   = range( $max_num_pages - $end_size + 1, $max_num_pages );
$mid_pages   = range( $current_page - $mid_size, $current_page + $mid_size );
$pages       = array_intersect( range( 1, $max_num_pages ), array_merge( $start_pages, $end_pages, $mid_pages ) );
$prev_page   = 0;
?>

<nav class="event-manager-pagination congin-pagination">
	<ul class="page-numbers">
		<?php if ( $current_page && $current_page > 1 ) : ?>
			<li><a href="#" data-page="<?php echo  esc_attr($current_page - 1); ?>" class="page-numbers"><i class="ci-chevron-left"></i></a></li>
		<?php endif; ?>
		
		<?php
			foreach ( $pages as $page ) {

				if ( $prev_page != $page - 1 ) { ?>
					<li><span class="gap">...</span></li>
				<?php }

				if ( $current_page == $page ) { ?>
					<li><span  data-page="<?php echo esc_attr($page);?>" class="page-numbers current"><?php echo esc_html($page);?></span></li>
				<?php } else { ?>
					<li><a href="#" data-page="<?php echo esc_attr($page);?>" class="page-numbers"><?php echo esc_html($page);?></a></li>
				<?php }

				$prev_page = $page;
			}
		?>

		<?php if ( $current_page && $current_page < $max_num_pages ) : ?>
			<li><a href="#" data-page="<?php echo  esc_attr($current_page + 1); ?>" class="page-numbers"><i class="ci-chevron-right"></i></a></li>
		<?php endif; ?>
	</ul>
</nav>