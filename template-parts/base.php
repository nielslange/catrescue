<?php
/**
 * Base template part for displaying content
 *
 * @package Catrescue
 */

$content_type = isset( $args['content_type'] ) ? $args['content_type'] : 'content';
$show_sidebar = isset( $args['show_sidebar'] ) ? $args['show_sidebar'] : true;
$show_title   = isset( $args['show_title'] ) ? $args['show_title'] : true;
$custom_title = isset( $args['custom_title'] ) ? $args['custom_title'] : '';
?>

<main>
	<div class="main-inner<?php echo ! $show_sidebar ? ' full-width' : ''; ?>">

		<div class="main-content">

			<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/' . $content_type );

					if ( ! is_search() && ( comments_open() || get_comments_number() ) ) {
						comments_template();
					}
				}

				get_template_part( 'template-parts/pagination' );
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>

		</div>

		<?php if ( $show_sidebar ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>
	</div>
</main>
