<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Catrescue
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}
?>

<div class="main-sidebar">
	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside>
</div>
