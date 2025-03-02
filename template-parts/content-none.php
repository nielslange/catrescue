<?php
/**
 * Template part for displaying a message when no content is found
 *
 * @package Catrescue
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'catrescue' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_search() ) : ?>
			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'catrescue' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>
			<p><?php esc_html_e( 'It seems we cannot find what you are looking for. Perhaps searching can help.', 'catrescue' ); ?></p>
			<?php get_search_form(); ?>
		<?php endif; ?>
	</div>
</section>
