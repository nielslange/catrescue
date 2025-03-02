<?php
/**
 * Template part for displaying 404 content
 *
 * @package Catrescue
 */

?>

<section class="error-404 not-found">

	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Oops! That page can\'t be found.', 'catrescue' ); ?></h1>
	</header>

	<div class="page-content">
		<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'catrescue' ); ?></p>

		<?php get_search_form(); ?>
	</div>

</section>
