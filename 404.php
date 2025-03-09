<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Catrescue
 */

get_header();

?>

<main>
	<div class="main-inner">
		<div class="main-content">
			<header class="page-header">
				<h1 class="page-title">
					<?php esc_html_e( 'Oops! That page can\'t be found.', 'catrescue' ); ?>
				</h1>
			</header>
			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'catrescue' ); ?></p>
			</div>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main>

<?php

get_footer();
