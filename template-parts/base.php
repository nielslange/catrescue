<?php
/**
 * Base template part for displaying content
 *
 * @package Catrescue
 */

$content_type = isset( $args['content_type'] ) ? $args['content_type'] : 'content';
$show_sidebar = isset( $args['show_sidebar'] ) ? $args['show_sidebar'] : true;
$main_class   = isset( $args['main_class'] ) ? $args['main_class'] : '';
$inner_class  = isset( $args['inner_class'] ) ? $args['inner_class'] : '';
$show_title   = isset( $args['show_title'] ) ? $args['show_title'] : true;
$custom_title = isset( $args['custom_title'] ) ? $args['custom_title'] : '';
?>

<main<?php echo $main_class ? ' class="' . esc_attr( $main_class ) . '"' : ''; ?>>
	<div class="main-inner<?php echo ! $show_sidebar ? ' full-width' : ''; ?><?php echo $inner_class ? ' ' . esc_attr( $inner_class ) : ''; ?>">

		<div class="main-content">

		<?php if ( $show_title && ( is_archive() || is_search() || $custom_title ) ) : ?>
			<header class="page-header">
				<?php
				if ( $custom_title ) {
					echo '<h1 class="page-title">' . esc_html( $custom_title ) . '</h1>';
				} elseif ( is_search() ) {
					printf(
						/* translators: %s: search query. */
						'<h1 class="page-title">' . esc_html__( 'Search results for: %s', 'catrescue' ) . '</h1>',
						'<span>' . get_search_query() . '</span>'
					);
				} elseif ( is_archive() ) {
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="archive-description">', '</div>' );
				}
				?>
			</header>
		<?php endif; ?>

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
