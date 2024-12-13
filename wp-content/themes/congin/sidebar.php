<?php
// Get layout position
$layout = congin_layout_position();
if ( $layout == 'no-sidebar' ) return;

$sidebar = 'sidebar-blog';

if ( is_page() ) $sidebar = 'sidebar-page';
if ( is_singular( 'service' ) ) $sidebar = 'sidebar-service';
if ( is_singular( 'give_forms' ) ) $sidebar = 'sidebar-give';

if ( congin_is_woocommerce_page() )
	$sidebar = 'sidebar-shop';

if ( is_active_sidebar( $sidebar ) ) {

	?>

	<div id="sidebar">
		<div id="inner-sidebar" class="inner-content-wrap">
			<?php dynamic_sidebar( $sidebar ); ?>
		</div><!-- /#inner-sidebar -->
	</div><!-- /#sidebar -->

	<?php } ?>