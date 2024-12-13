<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $max_num_pages <= 1 ) {
	return;
}
?>

echo congin_pagination();
